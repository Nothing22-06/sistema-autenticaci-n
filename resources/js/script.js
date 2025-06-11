        // Configuración de la API
        const API_BASE_URL = 'http://localhost:8000/api';

        // Elementos del DOM
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const dashboard = document.getElementById('dashboard');
        const messageContainer = document.getElementById('messageContainer');
        const registerMessageContainer = document.getElementById('registerMessageContainer');

        // Verificar si hay token al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('jwt_token');
            if (token) {
                verifyToken(token);
            }
        });

        // Cambiar entre formularios
        function showLogin() {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            clearMessages();
        }

        function showRegister() {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            clearMessages();
        }

        function showDashboard() {
            loginForm.classList.add('hidden');
            registerForm.classList.add('hidden');
            dashboard.style.display = 'block';
        }

        // Limpiar mensajes
        function clearMessages() {
            messageContainer.innerHTML = '';
            registerMessageContainer.innerHTML = '';
        }

        // Mostrar mensaje
        function showMessage(container, message, type = 'error') {
            container.innerHTML = `<div class="message ${type}">${message}</div>`;
        }

        // Loading state
        function setLoading(button, loading) {
            const btnText = button.querySelector('.btn-text');
            const loadingSpinner = button.querySelector('.loading');

            if (loading) {
                btnText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
                button.disabled = true;
            } else {
                btnText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
                button.disabled = false;
            }
        }

        // Login
        document.getElementById('loginFormElement').addEventListener('submit', async function(e) {
            e.preventDefault();

            const loginBtn = document.getElementById('loginBtn');
            setLoading(loginBtn, true);
            clearMessages();

            const formData = new FormData(this);
            const data = {
                email: formData.get('email'),
                password: formData.get('password')
            };

            try {
                const response = await fetch(`${API_BASE_URL}/auth/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    localStorage.setItem('jwt_token', result.authorization.token);
                    localStorage.setItem('user_data', JSON.stringify(result.user));
                    showMessage(messageContainer, result.message, 'success');

                    setTimeout(() => {
                        loadUserDashboard(result.user);
                        showDashboard();
                    }, 1000);
                } else {
                    showMessage(messageContainer, result.message);
                }
            } catch (error) {
                showMessage(messageContainer, 'Error de conexión. Verifica que el servidor esté funcionando.');
            } finally {
                setLoading(loginBtn, false);
            }
        });

        // Registro
        document.getElementById('registerFormElement').addEventListener('submit', async function(e) {
            e.preventDefault();
            const registerBtn = document.getElementById('registerBtn');
            setLoading(registerBtn, true);
            clearMessages();

            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation')
            };

            try {
                const response = await fetch(`${API_BASE_URL}/auth/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    localStorage.setItem('jwt_token', result.authorization.token);
                    localStorage.setItem('user_data', JSON.stringify(result.user));
                    showMessage(registerMessageContainer, result.message, 'success');
                    setTimeout(() => {
                        loadUserDashboard(result.user);
                        showDashboard();
                    }, 1000);
                } else {
                    let errorMessage = result.message;
                    if (result.errors) {
                        errorMessage += '<br>' + Object.values(result.errors).flat().join('<br>');
                    }
                    showMessage(registerMessageContainer, errorMessage);
                }
            } catch (error) {
                showMessage(registerMessageContainer, 'Error de conexión. Verifica que el servidor esté funcionando.');
            } finally {
                setLoading(registerBtn, false);
            }
        });

        // Verificar token
        async function verifyToken(token) {
            try {
                const response = await fetch(`${API_BASE_URL}/auth/me`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    loadUserDashboard(result.user);
                    showDashboard();
                } else {
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('user_data');
                }
            } catch (error) {
                localStorage.removeItem('jwt_token');
                localStorage.removeItem('user_data');
            }
        }

        // Cargar dashboard del usuario
        function loadUserDashboard(user) {
            const userInfo = document.getElementById('userInfo');
            userInfo.innerHTML = `
                <h3>Información del Usuario</h3>
                <p><strong>Nombre:</strong> ${user.name}</p>
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>Registrado:</strong> ${new Date(user.created_at).toLocaleDateString()}</p>
            `;
        }

        // Logout
        async function logout() {
            const token = localStorage.getItem('jwt_token');

            try {
                await fetch(`${API_BASE_URL}/auth/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.log('Error al hacer logout en el servidor');
            }

            localStorage.removeItem('jwt_token');
            localStorage.removeItem('user_data');
            dashboard.style.display = 'none';
            showLogin();
        }

        // Renovar token
        async function refreshToken() {
            const token = localStorage.getItem('jwt_token');

            try {
                const response = await fetch(`${API_BASE_URL}/auth/refresh`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    localStorage.setItem('jwt_token', result.authorization.token);
                    alert('Token renovado exitosamente');
                } else {
                    alert('Error al renovar token');
                    logout();
                }
            } catch (error) {
                alert('Error de conexión al renovar token');
            }
        }