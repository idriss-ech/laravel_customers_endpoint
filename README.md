
```markdown
# My Laravel Project

## Prerequisites

Before running the project, make sure you have the following installed:

- PHP (version 7.4 or above)
- Composer (dependency management)
- MySQL or another compatible database
- Laravel (preferably the latest stable version)

## Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/idriss-ech/laravel_customers_endpoint.git
cd your-project
```

### Step 2: Set Up Environment

1. Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

2. Open the `.env` file and configure the database connection. Modify the following lines with your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1       # Database host
DB_PORT=3306            # Database port
DB_DATABASE=your_database_name   # Your database name
DB_USERNAME=your_username       # Your database username
DB_PASSWORD=your_password       # Your database password
```

### Step 3: Install Dependencies

Run the following command to install all project dependencies via Composer:

```bash
composer install
```

### Step 4: Generate the Application Key

Generate the Laravel application key by running:

```bash
php artisan key:generate
```

### Step 5: Migrate the Database

If you haven't already created the necessary tables, run the migration command to set up your database schema:

```bash
php artisan migrate
```

### Step 6: Add a User to the Database

To interact with the API, you need to have at least one user in your database. You can add a user directly via a MySQL query or using a database seeder.

For example, to add a user manually in the MySQL shell:

```sql
INSERT INTO users (username, password) VALUES ('your_username', 'your_password');
```

Make sure to hash the password if it's for a real user:

```php
use Illuminate\Support\Facades\Hash;
$hashedPassword = Hash::make('your_password');
```

You can also use Laravel's built-in artisan command to create users.

### Step 7: Send a Request

Once you have added a user to the database, you can send a request to interact with your API. 

Make sure to add **Basic Authentication** in the HTTP header for authorization:

- **Authorization**: `Basic <base64(username:password)>`

#### Example Using `curl`:

```bash
curl -X GET http://127.0.0.1:8000/api/users \
     -H "Authorization: Basic base64(username:password)"
```

Where `base64(username:password)` is the base64-encoded string of `username:password`.

#### Example Using Postman:

1. Open Postman.
2. Set the method to **GET** and the URL to `http://127.0.0.1:8000/api/users`.
3. In the **Authorization** tab, select **Basic Auth** and enter the username and password.
4. Click **Send** to make the request.

### Step 8: Authentication Middleware

The project uses **Basic Authentication** via a middleware. The middleware checks the credentials and ensures the user is authenticated before allowing access to protected routes.

- The username and password are checked using the `auth.basic` middleware that comes pre-configured with Laravel.

### Configuration of the Authentication Middleware

Laravel’s `auth.basic` middleware will use the credentials passed in the **Authorization** header to authenticate the user. If the credentials are valid, the request is processed; otherwise, a **401 Unauthorized** error is returned.

---

## API Documentation

### Endpoints:

#### 1. `GET /api/users`

Fetch all users from the database. This route is protected by basic authentication.

**Request:**
```bash
curl -X GET http://127.0.0.1:8000/api/users \
     -H "Authorization: Basic base64(username:password)"
```

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "johndoe@example.com"
        },
        {
            "id": 2,
            "name": "Jane Doe",
            "email": "janedoe@example.com"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/users?page=1",
        "last": "http://127.0.0.1:8000/api/users?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://127.0.0.1:8000/api/users",
        "per_page": 15,
        "to": 10,
        "total": 10
    }
}
```

---

## Troubleshooting

- **Unauthorized Error**: Make sure the username and password provided are correct and are base64-encoded properly.
- **Database Connection Error**: Ensure the database credentials in the `.env` file are accurate and the database is running.
- **Missing Users**: If no users are returned, ensure you have at least one user in your database.

---

