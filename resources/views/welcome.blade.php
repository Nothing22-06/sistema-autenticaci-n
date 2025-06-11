<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 1.5rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Login Form */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Dashboard Content */
        .dashboard {
            display: none;
            min-height: 100vh;
        }

        .main-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-icon.users { background: #e3f2fd; color: #1976d2; }
        .stat-icon.online { background: #e8f5e8; color: #388e3c; }
        .stat-icon.today { background: #fff3e0; color: #f57c00; }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Users Table */
        .users-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .section-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
        }

        .search-bar {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            padding: 0.5rem 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 0.9rem;
            width: 250px;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th,
        .users-table td {
            padding: 1rem 2rem;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .users-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .users-table tr:hover {
            background: #f8f9ff;
        }

        .user-avatar-small {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-details h4 {
            margin: 0;
            font-size: 0.9rem;
            color: #333;
        }

        .user-details p {
            margin: 0;
            font-size: 0.8rem;
            color: #666;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-inactive {
            background: #fce4ec;
            color: #c2185b;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            animation: slideIn 0.3s ease;
        }

        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 2rem;
        }

        .close {
            color: #aaa;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
        }

        .close:hover {
            color: #333;
        }

        /* Messages */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .hidden {
            display: none !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }
            
            .search-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
            }
            
            .search-input {
                width: 100%;
            }
            
            .users-table {
                font-size: 0.8rem;
            }
            
            .users-table th,
            .users-table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Login Form -->
    <div id="loginContainer" class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Panel Administrativo</h1>
                <p>Ingresa tus credenciales para acceder</p>
            </div>

            <div id="loginMessage"></div>

            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" id="loginBtn" style="width: 100%;">
                    <span class="btn-text">Iniciar Sesión</span>
                    <span class="loading hidden"></span>
                </button>
            </form>
        </div>
    </div>

    <!-- Dashboard -->
    <div id="dashboard" class="dashboard">
        <!-- Header -->
        <header class="header">
            <h1>Dashboard Administrativo</h1>
            <div class="user-menu">
                <span id="currentUserName">Admin</span>
                <div class="user-avatar" id="userAvatar">A</div>
                <button class="btn btn-success btn-sm" onclick="refreshToken()">Nuevo Token</button>
                <button class="btn btn-secondary btn-sm" onclick="logout()">Salir</button>
            </div>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon users">👥</div>
                    <div class="stat-number" id="totalUsers">0</div>
                    <div class="stat-label">Total Usuarios</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon today">📅</div>
                    <div class="stat-number" id="newUsersToday">0</div>
                    <div class="stat-label">Nuevos Hoy</div>
                </div>
            </div>

            <!-- Users Section -->
            <div class="users-section">
                <div class="section-header">
                    <h2 class="section-title">Gestión de Usuarios</h2>
                    <div class="search-bar">
                        <input type="text" class="search-input" id="searchUsers" placeholder="Buscar usuarios...">
                        <button class="btn btn-primary" onclick="openCreateModal()">
                            + Nuevo Usuario
                        </button>
                    </div>
                </div>

                <div id="usersTableContainer">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            <!-- Users will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Crear Usuario</h3>
                <button class="close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="modalMessage"></div>
                <form id="userForm">
                    <input type="hidden" id="userId" name="id">
                    <div class="form-group">
                        <label for="userName">Nombre</label>
                        <input type="text" id="userName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" id="userEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Contraseña</label>
                        <input type="password" id="userPassword" name="password">
                        <small style="color: #666;">Dejar vacío para mantener la contraseña actual (solo en edición)</small>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" id="saveUserBtn">
                            <span class="btn-text">Guardar</span>
                            <span class="loading hidden"></span>
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Configuration
        const API_BASE_URL = 'https://sistema-autenticaci-n-production.up.railway.app/api';
        let users = [];
        let filteredUsers = [];
        let currentUser = null;
        let editingUserId = null;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            checkAuth();
        });

        // Authentication
        function checkAuth() {
            const token = localStorage.getItem('jwt_token');
            if (token) {
                verifyToken(token);
            }
        }

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
                    currentUser = result.user;
                    showDashboard();
                    loadUsers();
                } else {
                    showLogin();
                }
            } catch (error) {
                showLogin();
            }
        }

        // Login
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const loginBtn = document.getElementById('loginBtn');
            setLoading(loginBtn, true);
            clearMessage('loginMessage');

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
                    currentUser = result.user;
                    showMessage('loginMessage', result.message, 'success');
                    
                    setTimeout(() => {
                        showDashboard();
                        loadUsers();
                    }, 1000);
                } else {
                    showMessage('loginMessage', result.message, 'error');
                }
            } catch (error) {
                showMessage('loginMessage', 'Error de conexión. Verifica que el servidor esté funcionando.', 'error');
            } finally {
                setLoading(loginBtn, false);
            }
        });

        // Show/Hide sections
        function showLogin() {
            document.getElementById('loginContainer').style.display = 'flex';
            document.getElementById('dashboard').style.display = 'none';
        }

        function showDashboard() {
            document.getElementById('loginContainer').style.display = 'none';
            document.getElementById('dashboard').style.display = 'block';
            updateUserInfo();
        }

        function updateUserInfo() {
            if (currentUser) {
                document.getElementById('currentUserName').textContent = currentUser.name;
                document.getElementById('userAvatar').textContent = currentUser.name.charAt(0).toUpperCase();
            }
        }

        // Load users
        async function loadUsers() {
            try {
                const token = localStorage.getItem('jwt_token');
                const response = await fetch(`${API_BASE_URL}/users`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    users = result.users || result.data || [];
                    filteredUsers = [...users];
                    updateStats();
                    renderUsersTable();
                } else {
                    console.error('Error loading users:', result.message);
                }
            } catch (error) {
                console.error('Error loading users:', error);
            }
        }

        // Update statistics
        function updateStats() {
            const totalUsers = users.length;

            // Calculamos nuevos usuarios hoy
            const today = new Date().toDateString();
            const newUsersToday = users.filter(user => 
                new Date(user.created_at).toDateString() === today
            ).length;

            document.getElementById('totalUsers').textContent = totalUsers;
            document.getElementById('newUsersToday').textContent = newUsersToday;
        }

        // Render users table
        function renderUsersTable() {
            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = '';

            filteredUsers.forEach(user => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>
                        <div class="user-info">
                            <div class="user-avatar-small">${user.name.charAt(0).toUpperCase()}</div>
                            <div class="user-details">
                                <h4>${user.name}</h4>
                                <p>ID: ${user.id}</p>
                            </div>
                        </div>
                    </td>
                    <td>${user.email}</td>
                    <td>${new Date(user.created_at).toLocaleDateString()}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editUser(${user.id})">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">
                                Eliminar
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Search users
        document.getElementById('searchUsers').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredUsers = users.filter(user => 
                user.name.toLowerCase().includes(searchTerm) ||
                user.email.toLowerCase().includes(searchTerm)
            );
            renderUsersTable();
        });

        // Modal functions
        function openCreateModal() {
            editingUserId = null;
            document.getElementById('modalTitle').textContent = 'Crear Usuario';
            document.getElementById('userForm').reset();
            document.getElementById('userId').value = '';
            document.getElementById('userPassword').required = true;
            clearMessage('modalMessage');
            document.getElementById('userModal').style.display = 'block';
        }

        function editUser(id) {
            const user = users.find(u => u.id === id);
            if (!user) return;

            editingUserId = id;
            document.getElementById('modalTitle').textContent = 'Editar Usuario';
            document.getElementById('userId').value = user.id;
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userPassword').value = '';
            document.getElementById('userPassword').required = false;
            clearMessage('modalMessage');
            document.getElementById('userModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('userModal').style.display = 'none';
            editingUserId = null;
        }

        // User form submission
        document.getElementById('userForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const saveBtn = document.getElementById('saveUserBtn');
            setLoading(saveBtn, true);
            clearMessage('modalMessage');

            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                email: formData.get('email')
            };

            if (formData.get('password')) {
                data.password = formData.get('password');
                data.password_confirmation = formData.get('password');
            }

            try {
                const token = localStorage.getItem('jwt_token');
                const isEditing = editingUserId !== null;
                const url = isEditing ? 
                    `${API_BASE_URL}/users/${editingUserId}` : 
                    `${API_BASE_URL}/users`;
                const method = isEditing ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    showMessage('modalMessage', 
                        isEditing ? 'Usuario actualizado exitosamente' : 'Usuario creado exitosamente', 
                        'success'
                    );
                    
                    setTimeout(() => {
                        closeModal();
                        loadUsers();
                    }, 1500);
                } else {
                    let errorMessage = result.message;
                    if (result.errors) {
                        errorMessage += '<br>' + Object.values(result.errors).flat().join('<br>');
                    }
                    showMessage('modalMessage', errorMessage, 'error');
                }
            } catch (error) {
                showMessage('modalMessage', 'Error de conexión', 'error');
            } finally {
                setLoading(saveBtn, false);
            }
        });

        // Renovar token
        async function refreshToken() {
            const token = localStorage.getItem('jwt_token');
            if (!token) {
                alert('No hay token almacenado');
                return;
            }

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
                    alert('Error al renovar token: ' + result.message);
                    logout();
                }
            } catch (error) {
                alert('Error de conexión al renovar token');
            }
        }

        // verificar token
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
                    currentUser = result.user;
                    showDashboard();
                    loadUsers();
                } else {
                    // Intentar renovar el token si está expirado
                    if (result.message.includes('expired')) {
                        const refreshResponse = await fetch(`${API_BASE_URL}/auth/refresh`, {
                            method: 'POST',
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Accept': 'application/json'
                            }
                        });

                        const refreshResult = await refreshResponse.json();
                        
                        if (refreshResult.success) {
                            localStorage.setItem('jwt_token', refreshResult.authorization.token);
                            currentUser = refreshResult.user;
                            showDashboard();
                            loadUsers();
                            return;
                        }
                    }
                    showLogin();
                }
            } catch (error) {
                showLogin();
            }
        }

        // Delete user
        async function deleteUser(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
                return;
            }

            try {
                const token = localStorage.getItem('jwt_token');
                const response = await fetch(`${API_BASE_URL}/users/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    loadUsers();
                } else {
                    alert('Error al eliminar usuario: ' + result.message);
                }
            } catch (error) {
                alert('Error de conexión al eliminar usuario');
            }
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
            currentUser = null;
            showLogin();
        }

        // Utility functions
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

        function showMessage(containerId, message, type = 'error') {
            const container = document.getElementById(containerId);
            container.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
        }

        function clearMessage(containerId) {
            document.getElementById(containerId).innerHTML = '';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('userModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>