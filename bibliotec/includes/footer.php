            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section">
                        <h4>Bibliotec</h4>
                        <p>Biblioteca com a parceria da Etec Maria Cristina Medeiros onde mostramos livros famosos para abrir sua imaginação</p>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Links Rápidos</h4>
                        <a href="<?= $eh_pagina_admin ? '../index.php' : 'index.php' ?>">Início</a>
                        <a href="<?= $eh_pagina_admin ? '../categorias.php' : 'categorias.php' ?>">Categorias</a>
                        <a href="<?= $eh_pagina_admin ? '../sobre.php' : 'sobre.php' ?>">Sobre</a>
                        <?php if(isset($_SESSION['usuario_id'])): ?>
                            <a href="<?= $eh_pagina_admin ? '../usuario.php' : 'usuario.php' ?>">Meu Perfil</a>
                            <?php if($_SESSION['usuario_tipo'] == 'admin' && !$eh_pagina_admin): ?>
                                <a href="admin/dashboard.php">Área Admin</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?= $eh_pagina_admin ? '../login.php' : 'login.php' ?>">Login</a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Contato</h4>
                        <a href="mailto:contato@bibliotec.com">contato@bibliotec.com</a>
                        <a href="tel:+551199999999">(11) 9999-9999</a>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; 2025 Bibliotec. Todos os direitos reservados.</p>
                    <p>Desenvolvido por Kevin, Angelo, Anna Beatriz, Arthur e Isabele - 2ºF - ETEC</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= $eh_pagina_admin ? '../' : '' ?>assets/js/script.js"></script>
    
    <script>
        // Menu mobile - corrigido para funcionar em admin também
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            if (navLinks.style.display === 'flex') {
                navLinks.style.display = 'none';
            } else {
                navLinks.style.display = 'flex';
            }
        });

        // Fechar menu ao clicar em um link (mobile)
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                const navLinks = document.querySelector('.nav-links');
                if (window.innerWidth <= 768) {
                    navLinks.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>