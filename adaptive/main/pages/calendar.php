<?php
$page_title = 'Calendário de Treinos';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$workouts = [];

// Buscar treinos do usuário
$result = $conn->query("SELECT * FROM workouts WHERE user_id = $user_id ORDER BY date DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $workouts[] = $row;
    }
}

// Processar novo treino
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_workout'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $duration = (int)$_POST['duration'];
    $type = $conn->real_escape_string($_POST['type']);

    $sql = "INSERT INTO workouts (user_id, title, description, date, time, duration, type) 
            VALUES ($user_id, '$title', '$description', '$date', '$time', $duration, '$type')";
    
    if ($conn->query($sql)) {
        header('Refresh: 0');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - FitZone</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .calendar-container {
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            animation: fadeIn 0.6s ease-in;
        }

        .calendar-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .calendar-form {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            animation: slideUp 0.6s ease-out;
        }

        .calendar-form h3 {
            color: var(--accent-bright);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--ice);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 0.5rem;
            background: rgba(0, 0, 0, 0.3);
            color: var(--ice);
            font-family: var(--font-inter);
            transition: var(--transition);
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-bright);
            box-shadow: 0 0 1rem rgba(0, 212, 255, 0.3);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-bright) 100%);
            color: #0F1419;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4);
        }

        .calendar-stats {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            animation: slideUp 0.6s ease-out 0.1s backwards;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(0, 212, 255, 0.05);
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--accent-bright);
        }

        .stat-content h4 {
            color: var(--accent-bright);
            margin-bottom: 0.25rem;
        }

        .stat-content p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .workouts-list {
            margin-top: 3rem;
        }

        .workouts-list h3 {
            color: var(--accent-bright);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .workout-item {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.1);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: var(--transition);
            animation: fadeInUp 0.6s ease-out;
        }

        .workout-item:hover {
            border-color: var(--accent-bright);
            background: rgba(0, 212, 255, 0.1);
        }

        .workout-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .workout-title {
            color: var(--accent-bright);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .workout-type {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(0, 212, 255, 0.2);
            border: 1px solid var(--accent);
            border-radius: 2rem;
            color: var(--accent-bright);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .workout-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .workout-detail {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray);
        }

        .workout-detail i {
            color: var(--accent-bright);
        }

        .workout-description {
            color: var(--ice);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .workout-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.4rem;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-complete {
            background: rgba(0, 255, 0, 0.2);
            color: #51cf66;
            border: 1px solid rgba(0, 255, 0, 0.3);
        }

        .btn-complete:hover {
            background: rgba(0, 255, 0, 0.3);
        }

        .btn-delete {
            background: rgba(255, 0, 0, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(255, 0, 0, 0.3);
        }

        .btn-delete:hover {
            background: rgba(255, 0, 0, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .calendar-header {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="calendar-container">
        <div class="container">
            <div class="calendar-header">
                <div class="calendar-form">
                    <h3><i class="fas fa-plus-circle"></i> Agendar Novo Treino</h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="title">Título do Treino</label>
                            <input type="text" id="title" name="title" placeholder="Ex: Treino de Perna" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Tipo de Treino</label>
                            <select id="type" name="type" required>
                                <option value="">Selecione um tipo</option>
                                <option value="musculacao">Musculação</option>
                                <option value="cardio">Cardio</option>
                                <option value="yoga">Yoga</option>
                                <option value="pilates">Pilates</option>
                                <option value="crossfit">CrossFit</option>
                                <option value="hiit">HIIT</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">Data</label>
                            <input type="date" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Horário</label>
                            <input type="time" id="time" name="time" required>
                        </div>

                        <div class="form-group">
                            <label for="duration">Duração (minutos)</label>
                            <input type="number" id="duration" name="duration" min="15" max="180" step="15" placeholder="60" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descrição (Opcional)</label>
                            <textarea id="description" name="description" placeholder="Detalhes do seu treino..."></textarea>
                        </div>

                        <button type="submit" name="add_workout" class="btn-submit">
                            <i class="fas fa-calendar-plus"></i> Agendar Treino
                        </button>
                    </form>
                </div>

                <div class="calendar-stats">
                    <h3 style="color: var(--accent-bright); margin-bottom: 1.5rem;">
                        <i class="fas fa-chart-bar"></i> Estatísticas
                    </h3>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Total de Treinos</h4>
                            <p><?php echo count($workouts); ?> treinos agendados</p>
                        </div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Treinos Completos</h4>
                            <p><?php echo count(array_filter($workouts, fn($w) => $w['status'] === 'completed')); ?> concluídos</p>
                        </div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Próximo Treino</h4>
                            <p><?php 
                                $upcoming = array_filter($workouts, fn($w) => $w['status'] === 'scheduled' && strtotime($w['date']) >= time());
                                echo count($upcoming) > 0 ? reset($upcoming)['date'] : 'Nenhum agendado';
                            ?></p>
                        </div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Tempo Total</h4>
                            <p><?php echo array_sum(array_column($workouts, 'duration')); ?> minutos</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="workouts-list">
                <h3><i class="fas fa-list"></i> Meus Treinos</h3>

                <?php if (empty($workouts)): ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h4>Nenhum treino agendado</h4>
                        <p>Comece a agendar seus treinos usando o formulário acima!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($workouts as $workout): ?>
                        <div class="workout-item">
                            <div class="workout-header">
                                <div>
                                    <div class="workout-title"><?php echo htmlspecialchars($workout['title']); ?></div>
                                    <span class="workout-type"><?php echo ucfirst($workout['type']); ?></span>
                                </div>
                                <span class="workout-type" style="background: <?php echo $workout['status'] === 'completed' ? 'rgba(0, 255, 0, 0.2)' : 'rgba(0, 212, 255, 0.2)'; ?>; border-color: <?php echo $workout['status'] === 'completed' ? 'rgba(0, 255, 0, 0.5)' : 'rgba(0, 212, 255, 0.5)'; ?>;">
                                    <?php echo ucfirst($workout['status']); ?>
                                </span>
                            </div>

                            <div class="workout-details">
                                <div class="workout-detail">
                                    <i class="fas fa-calendar"></i>
                                    <span><?php echo date('d/m/Y', strtotime($workout['date'])); ?></span>
                                </div>
                                <div class="workout-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo date('H:i', strtotime($workout['time'])); ?></span>
                                </div>
                                <div class="workout-detail">
                                    <i class="fas fa-hourglass-half"></i>
                                    <span><?php echo $workout['duration']; ?> minutos</span>
                                </div>
                            </div>

                            <?php if ($workout['description']): ?>
                                <div class="workout-description">
                                    <?php echo htmlspecialchars($workout['description']); ?>
                                </div>
                            <?php endif; ?>

                            <div class="workout-actions">
                                <?php if ($workout['status'] === 'scheduled'): ?>
                                    <button class="btn-small btn-complete" onclick="completeWorkout(<?php echo $workout['id']; ?>)">
                                        <i class="fas fa-check"></i> Marcar como Completo
                                    </button>
                                <?php endif; ?>
                                <button class="btn-small btn-delete" onclick="deleteWorkout(<?php echo $workout['id']; ?>)">
                                    <i class="fas fa-trash"></i> Deletar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function completeWorkout(id) {
            if (confirm('Marcar este treino como completo?')) {
                window.location.href = '../api/complete_workout.php?id=' + id;
            }
        }

        function deleteWorkout(id) {
            if (confirm('Tem certeza que deseja deletar este treino?')) {
                window.location.href = '../api/delete_workout.php?id=' + id;
            }
        }

        // Flatpickr para date picker
        flatpickr("#date", {
            minDate: "today",
            dateFormat: "Y-m-d"
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
