<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

// Processar ações do CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cadastrar_livro'])) {
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $genero = trim($_POST['genero']);
        $ano_publicado = $_POST['ano_publicado'];
        $editora = trim($_POST['editora']);
        $numero_paginas = $_POST['numero_paginas'];
        
        // Processar upload da imagem
        $imagem_url = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $imagem_url = uploadImagem($_FILES['imagem']);
        }
        
        $stmt = $pdo->prepare("INSERT INTO LIVROS (titulo, autor, genero, ano_publicado, editora, numero_paginas, imagem_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$titulo, $autor, $genero, $ano_publicado, $editora, $numero_paginas, $imagem_url])) {
            $_SESSION['sucesso'] = "Livro cadastrado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar livro!";
        }
    }
    
    if (isset($_POST['excluir_livro'])) {
        $id_livro = $_POST['id_livro'];
        
        // Buscar imagem para excluir do servidor
        $stmt_img = $pdo->prepare("SELECT imagem_url FROM LIVROS WHERE id_livro = ?");
        $stmt_img->execute([$id_livro]);
        $livro = $stmt_img->fetch();
        
        if ($livro && $livro['imagem_url']) {
            $caminho_imagem = $_SERVER['DOCUMENT_ROOT'] . $livro['imagem_url'];
            if (file_exists($caminho_imagem)) {
                unlink($caminho_imagem);
            }
        }
        
        $stmt = $pdo->prepare("DELETE FROM LIVROS WHERE id_livro = ?");
        if ($stmt->execute([$id_livro])) {
            $_SESSION['sucesso'] = "Livro excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir livro!";
        }
    }
    
    header("Location: livros.php");
    exit;
}

// Função para upload de imagem
function uploadImagem($arquivo) {
    $pasta_upload = '../img/livros/';
    
    // Criar pasta se não existir
    if (!is_dir($pasta_upload)) {
        mkdir($pasta_upload, 0777, true);
    }
    
    // Validar tipo de arquivo
    $tipos_permitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    $tipo_arquivo = mime_content_type($arquivo['tmp_name']);
    
    if (!in_array($tipo_arquivo, $tipos_permitidos)) {
        $_SESSION['erro'] = "Tipo de arquivo não permitido. Use JPG, PNG ou GIF.";
        return null;
    }
    
    // Validar tamanho (máximo 2MB)
    if ($arquivo['size'] > 2 * 1024 * 1024) {
        $_SESSION['erro'] = "Arquivo muito grande. Tamanho máximo: 2MB.";
        return null;
    }
    
    // Gerar nome único para o arquivo
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $nome_arquivo = uniqid() . '_' . time() . '.' . $extensao;
    $caminho_completo = $pasta_upload . $nome_arquivo;
    
    // Mover arquivo
    if (move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
        return '/biblioteca/img/livros/' . $nome_arquivo;
    }
    
    return null;
}

// Buscar todos os livros
$livros = $pdo->query("SELECT * FROM LIVROS ORDER BY titulo")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Livros - Bibliotec</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <style>
        .admin-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .form-container {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .upload-area {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--background);
        }

        .upload-area:hover {
            border-color: var(--primary-main);
            background: var(--primary-light);
        }

        .upload-area.dragover {
            border-color: var(--primary-main);
            background: var(--primary-light);
        }

        .preview-imagem {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 1rem;
            display: none;
        }

        .table-container {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: var(--background);
            font-weight: 600;
            color: var(--primary-dark);
        }

        .livro-imagem {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .sem-imagem {
            width: 60px;
            height: 80px;
            background: var(--background);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
        }

        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            background: #c53030;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <div class="admin-actions">
            <h1>Gerenciar Livros</h1>
    <div style="display: flex; gap: 1rem;">
        <a href="../index.php" class="btn btn-outline">
            <i class="fas fa-globe"></i> Site Principal
        </a>
        <a href="dashboard.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
        </a>
    </div>

        <!-- Formulário de Cadastro -->
        <div class="form-container">
            <h2>Cadastrar Novo Livro</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="cadastrar_livro" value="1">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Autor *</label>
                        <input type="text" name="autor" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Gênero *</label>
                        <select name="genero" class="form-control" required>
                            <option value="">Selecione um gênero</option>
                            <option value="Terror">Terror</option>
                            <option value="Suspense">Suspense</option>
                            <option value="Fantasia">Fantasia</option>
                            <option value="Ficção Científica">Ficção Científica</option>
                            <option value="Romance">Romance</option>
                            <option value="Comédia">Comédia</option>
                            <option value="Aventura">Aventura</option>
                            <option value="Drama">Drama</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Ano de Publicação</label>
                        <input type="number" name="ano_publicado" class="form-control" min="1000" max="<?= date('Y') ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Editora</label>
                        <input type="text" name="editora" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Número de Páginas</label>
                        <input type="number" name="numero_paginas" class="form-control" min="1">
                    </div>
                </div>

                <!-- Upload de Imagem -->
                <div class="form-group">
                    <label class="form-label">Capa do Livro</label>
                    <div class="upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                        <p>Clique para selecionar ou arraste uma imagem</p>
                        <p style="font-size: 0.8rem; color: var(--text-muted);">
                            Formatos: JPG, PNG, GIF, WEBP (Máx: 2MB)
                        </p>
                        <input type="file" name="imagem" id="imagemInput" accept="image/*" style="display: none;">
                        <img id="previewImagem" class="preview-imagem" alt="Preview">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Cadastrar Livro
                </button>
            </form>
        </div>

        <!-- Lista de Livros -->
        <div class="table-container">
            <h2>Livros Cadastrados (<?= count($livros) ?>)</h2>
            
            <?php if(empty($livros)): ?>
                <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                    <i class="fas fa-book" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Nenhum livro cadastrado ainda.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Capa</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Gênero</th>
                            <th>Ano</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($livros as $livro): ?>
                        <tr>
                            <td>
                                <?php if($livro['imagem_url']): ?>
                                    <img src="..<?= $livro['imagem_url'] ?>" alt="<?= htmlspecialchars($livro['titulo']) ?>" class="livro-imagem">
                                <?php else: ?>
                                    <div class="sem-imagem">
                                        Sem<br>Imagem
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= htmlspecialchars($livro['titulo']) ?></strong></td>
                            <td><?= htmlspecialchars($livro['autor']) ?></td>
                            <td>
                                <span class="badge badge-primary"><?= htmlspecialchars($livro['genero']) ?></span>
                            </td>
                            <td><?= $livro['ano_publicado'] ?: '-' ?></td>
                            <td class="actions-cell">
                                <button class="btn btn-small btn-secondary" onclick="editarLivro(<?= $livro['id_livro'] ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="excluir_livro" value="1">
                                    <input type="hidden" name="id_livro" value="<?= $livro['id_livro'] ?>">
                                    <button type="submit" class="btn btn-small btn-danger" 
                                            onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <script>
        // Sistema de Upload com Drag & Drop
        const uploadArea = document.getElementById('uploadArea');
        const imagemInput = document.getElementById('imagemInput');
        const previewImagem = document.getElementById('previewImagem');

        // Clique na área de upload
        uploadArea.addEventListener('click', () => {
            imagemInput.click();
        });

        // Alteração no input de arquivo
        imagemInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                previewImage(file);
            }
        });

        // Drag & Drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                imagemInput.files = e.dataTransfer.files;
                previewImage(file);
            } else {
                alert('Por favor, selecione apenas arquivos de imagem.');
            }
        });

        // Preview da imagem
        function previewImage(file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImagem.src = e.target.result;
                previewImagem.style.display = 'block';
                
                // Atualizar texto da área de upload
                uploadArea.querySelector('p').textContent = file.name;
                uploadArea.querySelector('p').style.color = 'var(--primary-main)';
                uploadArea.querySelector('p').style.fontWeight = '600';
            }
            
            reader.readAsDataURL(file);
        }

        function editarLivro(id) {
            alert(`Funcionalidade de edição para o livro ID: ${id}\nEm uma implementação completa, aqui abriria um modal de edição.`);
        }

        // Validação do formulário
        document.querySelector('form').addEventListener('submit', function(e) {
            const titulo = document.querySelector('input[name="titulo"]').value.trim();
            const autor = document.querySelector('input[name="autor"]').value.trim();
            
            if (!titulo || !autor) {
                e.preventDefault();
                alert('Por favor, preencha pelo menos o título e o autor do livro.');
                return false;
            }
        });
    </script>
</body>
</html>