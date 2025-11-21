<?php
// functions.php - Funções auxiliares para o sistema Bibliotec

/**
 * Sanitiza dados de entrada para prevenir XSS
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Formata data para formato brasileiro
 */
function formatarData($data, $formato = 'd/m/Y') {
    if (!$data || $data == '0000-00-00' || $data == '0000-00-00 00:00:00') {
        return '-';
    }
    return date($formato, strtotime($data));
}

/**
 * Formata data e hora para formato brasileiro
 */
function formatarDataHora($data) {
    return formatarData($data, 'd/m/Y H:i');
}

/**
 * Verifica se um livro está favoritado pelo usuário
 */
function isFavorito($id_livro, $id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM favoritos WHERE id_livro = ? AND id_usuario = ?");
        $stmt->execute([$id_livro, $id_usuario]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Erro ao verificar favorito: " . $e->getMessage());
        return false;
    }
}

/**
 * Adiciona livro aos favoritos
 */
function adicionarFavorito($id_livro, $id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO favoritos (id_livro, id_usuario) VALUES (?, ?)");
        return $stmt->execute([$id_livro, $id_usuario]);
    } catch (PDOException $e) {
        error_log("Erro ao adicionar favorito: " . $e->getMessage());
        return false;
    }
}

/**
 * Remove livro dos favoritos
 */
function removerFavorito($id_livro, $id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM favoritos WHERE id_livro = ? AND id_usuario = ?");
        return $stmt->execute([$id_livro, $id_usuario]);
    } catch (PDOException $e) {
        error_log("Erro ao remover favorito: " . $e->getMessage());
        return false;
    }
}

/**
 * Obtém livros favoritos do usuário
 */
function getFavoritos($id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            SELECT l.*, f.data_favoritado 
            FROM LIVROS l 
            JOIN favoritos f ON l.id_livro = f.id_livro 
            WHERE f.id_usuario = ? 
            ORDER BY f.data_favoritado DESC
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erro ao buscar favoritos: " . $e->getMessage());
        return [];
    }
}

/**
 * Adiciona livro ao carrinho
 */
function adicionarAoCarrinho($id_livro, $id_usuario, $quantidade = 1) {
    global $pdo;
    try {
        // Verifica se já existe no carrinho
        $stmt = $pdo->prepare("SELECT id_item, quantidade FROM carrinho WHERE id_livro = ? AND id_usuario = ?");
        $stmt->execute([$id_livro, $id_usuario]);
        $item_existente = $stmt->fetch();
        
        if ($item_existente) {
            // Atualiza quantidade
            $nova_quantidade = $item_existente['quantidade'] + $quantidade;
            $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = ? WHERE id_item = ?");
            return $stmt->execute([$nova_quantidade, $item_existente['id_item']]);
        } else {
            // Insere novo item
            $stmt = $pdo->prepare("INSERT INTO carrinho (id_livro, id_usuario, quantidade) VALUES (?, ?, ?)");
            return $stmt->execute([$id_livro, $id_usuario, $quantidade]);
        }
    } catch (PDOException $e) {
        error_log("Erro ao adicionar ao carrinho: " . $e->getMessage());
        return false;
    }
}

/**
 * Remove item do carrinho
 */
function removerDoCarrinho($id_item, $id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM carrinho WHERE id_item = ? AND id_usuario = ?");
        return $stmt->execute([$id_item, $id_usuario]);
    } catch (PDOException $e) {
        error_log("Erro ao remover do carrinho: " . $e->getMessage());
        return false;
    }
}

/**
 * Atualiza quantidade no carrinho
 */
function atualizarQuantidadeCarrinho($id_item, $id_usuario, $quantidade) {
    global $pdo;
    try {
        if ($quantidade <= 0) {
            return removerDoCarrinho($id_item, $id_usuario);
        }
        
        $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = ? WHERE id_item = ? AND id_usuario = ?");
        return $stmt->execute([$quantidade, $id_item, $id_usuario]);
    } catch (PDOException $e) {
        error_log("Erro ao atualizar carrinho: " . $e->getMessage());
        return false;
    }
}

/**
 * Obtém carrinho do usuário
 */
function getCarrinho($id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            SELECT l.*, c.quantidade, c.id_item, c.data_adicionado 
            FROM LIVROS l 
            JOIN carrinho c ON l.id_livro = c.id_livro 
            WHERE c.id_usuario = ? 
            ORDER BY c.data_adicionado DESC
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erro ao buscar carrinho: " . $e->getMessage());
        return [];
    }
}

/**
 * Limpa o carrinho do usuário
 */
function limparCarrinho($id_usuario) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM carrinho WHERE id_usuario = ?");
        return $stmt->execute([$id_usuario]);
    } catch (PDOException $e) {
        error_log("Erro ao limpar carrinho: " . $e->getMessage());
        return false;
    }
}

/**
 * Obtém estatísticas do sistema
 */
function getEstatisticas() {
    global $pdo;
    try {
        $stats = [];
        
        // Total de livros
        $stmt = $pdo->query("SELECT COUNT(*) FROM LIVROS");
        $stats['total_livros'] = $stmt->fetchColumn();
        
        // Total de usuários (excluindo admins)
        $stmt = $pdo->query("SELECT COUNT(*) FROM USUARIO WHERE tipo = 'usuario'");
        $stats['total_usuarios'] = $stmt->fetchColumn();
        
        // Total de empréstimos
        $stmt = $pdo->query("SELECT COUNT(*) FROM EMPRESTIMO");
        $stats['total_emprestimos'] = $stmt->fetchColumn();
        
        // Total de autores
        $stmt = $pdo->query("SELECT COUNT(*) FROM AUTORES");
        $stats['total_autores'] = $stmt->fetchColumn();
        
        // Empréstimos ativos
        $stmt = $pdo->query("SELECT COUNT(*) FROM EMPRESTIMO WHERE data_devolucao_real IS NULL");
        $stats['emprestimos_ativos'] = $stmt->fetchColumn();
        
        return $stats;
    } catch (PDOException $e) {
        error_log("Erro ao buscar estatísticas: " . $e->getMessage());
        return [];
    }
}

/**
 * Gera avatar com iniciais do nome
 */
function gerarAvatar($nome, $tamanho = 100) {
    $iniciais = '';
    $nomes = explode(' ', $nome);
    
    if (count($nomes) >= 2) {
        $iniciais = strtoupper(substr($nomes[0], 0, 1) . substr($nomes[count($nomes)-1], 0, 1));
    } else {
        $iniciais = strtoupper(substr($nome, 0, 2));
    }
    
    return '<div class="avatar" style="width: ' . $tamanho . 'px; height: ' . $tamanho . 'px; background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: ' . ($tamanho * 0.4) . 'px;">' . $iniciais . '</div>';
}

/**
 * Valida formato de email
 */
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Gera senha hash
 */
function gerarHashSenha($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

/**
 * Verifica força da senha
 */
function verificarForcaSenha($senha) {
    $forca = 0;
    
    if (strlen($senha) >= 8) $forca++;
    if (preg_match('/[A-Z]/', $senha)) $forca++;
    if (preg_match('/[a-z]/', $senha)) $forca++;
    if (preg_match('/[0-9]/', $senha)) $forca++;
    if (preg_match('/[^A-Za-z0-9]/', $senha)) $forca++;
    
    return $forca;
}

/**
 * Formata número de telefone
 */
function formatarTelefone($telefone) {
    $telefone = preg_replace('/\D/', '', $telefone);
    
    if (strlen($telefone) === 11) {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
    } elseif (strlen($telefone) === 10) {
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
    }
    
    return $telefone;
}

/**
 * Retorna o nome do mês em português
 */
function getMesPortugues($numero_mes) {
    $meses = [
        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
    ];
    
    return $meses[$numero_mes] ?? '';
}

/**
 * Limita texto com reticências
 */
function limitarTexto($texto, $limite = 100) {
    if (strlen($texto) <= $limite) {
        return $texto;
    }
    
    $texto_limpo = strip_tags($texto);
    return substr($texto_limpo, 0, $limite) . '...';
}

/**
 * Gera breadcrumb
 */
function gerarBreadcrumb($pagina_atual, $pagina_anterior = null, $link_anterior = null) {
    $breadcrumb = '<nav class="breadcrumb"><a href="index.php">Início</a>';
    
    if ($pagina_anterior && $link_anterior) {
        $breadcrumb .= ' <span class="breadcrumb-separator">/</span> <a href="' . $link_anterior . '">' . $pagina_anterior . '</a>';
    }
    
    $breadcrumb .= ' <span class="breadcrumb-separator">/</span> <span class="breadcrumb-current">' . $pagina_atual . '</span></nav>';
    
    return $breadcrumb;
}

/**
 * Log de atividades do sistema
 */
function logAtividade($usuario_id, $acao, $detalhes = '') {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO log_atividades (usuario_id, acao, detalhes, ip, user_agent) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $usuario_id, 
            $acao, 
            $detalhes,
            $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
    } catch (PDOException $e) {
        error_log("Erro ao registrar log: " . $e->getMessage());
        return false;
    }
}
?>