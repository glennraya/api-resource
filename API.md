# Laravel API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
This API uses Laravel Sanctum for authentication with Bearer tokens.

## Endpoints

### Public Endpoints

#### Register User
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

**Response (201):**
```json
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2025-10-11T10:27:44.000000Z",
        "updated_at": "2025-10-11T10:27:44.000000Z"
    },
    "token": "1|abc123def456...",
    "token_type": "Bearer"
}
```

#### Login User
```http
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response (200):**
```json
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    },
    "token": "2|xyz789uvw456...",
    "token_type": "Bearer"
}
```

### Protected Endpoints
All protected endpoints require the Authorization header:
```
Authorization: Bearer {your-token-here}
```

#### Get Current User
```http
GET /api/user
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2025-10-11T10:27:44.000000Z",
    "updated_at": "2025-10-11T10:27:44.000000Z"
}
```

#### Logout (Current Token)
```http
POST /api/logout
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "message": "Logged out successfully"
}
```

#### Logout All Devices
```http
POST /api/logout-all
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "message": "Logged out from all devices"
}
```

## CSRF Protection
For frontend SPA integration, first call:
```http
GET /sanctum/csrf-cookie
```
This will set the necessary CSRF cookies for authenticated requests.

## CORS Configuration
Currently configured to allow all origins (`*`). Update `/config/cors.php` with your specific frontend domains before production:

```php
'allowed_origins' => ['http://localhost:3000', 'https://yourdomain.com'],
```

## Environment Configuration
Key environment variables in `.env`:
- `SANCTUM_STATEFUL_DOMAINS`: Comma-separated list of frontend domains
- `SESSION_DRIVER`: Set to `cookie` for SPA authentication
- `SESSION_DOMAIN`: Set to your domain (e.g., `localhost`)

## Frontend Integration Example

### Using Axios (JavaScript)
```javascript
// First, get CSRF cookie (for SPAs)
await axios.get('/sanctum/csrf-cookie');

// Register
const response = await axios.post('/api/register', {
    name: 'John Doe',
    email: 'john@example.com',
    password: 'password123'
});

// Set token for future requests
const token = response.data.token;
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

// Make authenticated requests
const user = await axios.get('/api/user');
```

### Using Fetch (JavaScript)
```javascript
// Login
const response = await fetch('/api/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({
        email: 'john@example.com',
        password: 'password123'
    })
});

const data = await response.json();
const token = data.token;

// Authenticated request
const userResponse = await fetch('/api/user', {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
    }
});
```

## Development
Start the development server:
```bash
php artisan serve
```

## Production Notes
Before deploying to production:

1. Update CORS configuration with specific domains
2. Set proper `SANCTUM_STATEFUL_DOMAINS` in production `.env`
3. Use HTTPS for all requests
4. Consider token expiration settings in `config/sanctum.php`