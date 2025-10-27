# Docker Development Setup

This guide explains how to use Docker Compose to run a local WordPress development environment for the VDaily theme.

## Prerequisites

- [Docker](https://www.docker.com/get-started) installed on your machine
- [Docker Compose](https://docs.docker.com/compose/install/) (usually included with Docker Desktop)

## Quick Start

### Option 1: Using Helper Script (Recommended)

```bash
# Run the installation helper
./docker-helper.sh install

# View other available commands
./docker-helper.sh help
```

### Option 2: Manual Setup

1. **Copy the environment file:**
   ```bash
   cp .env.example .env
   ```

2. **Start the Docker environment:**
   ```bash
   docker-compose up -d
   ```

3. **Access WordPress:**
   - WordPress site: http://localhost:8080
   - phpMyAdmin: http://localhost:8081

4. **Complete WordPress installation:**
   - Open http://localhost:8080 in your browser
   - Follow the WordPress installation wizard
   - Create your admin account

5. **Activate the VDaily theme:**
   - Go to WordPress Admin → Appearance → Themes
   - Activate "VDaily Tech Blog Theme"

## Services

The Docker Compose setup includes:

### WordPress (Port 8080)
- Latest WordPress 6.4 with PHP 8.2
- Debug mode enabled by default
- Theme automatically mounted to `/wp-content/themes/vdaily-theme`

### MySQL (Internal)
- MySQL 8.0 database
- Database name: `wordpress` (configurable)
- User: `wordpress` (configurable)
- Password: `wordpress` (configurable)

### phpMyAdmin (Port 8081)
- Web interface for database management
- Access at http://localhost:8081
- Login with root user and password from `.env` file

## Configuration

Edit the `.env` file to customize your environment:

```bash
# Change ports if they're already in use
WORDPRESS_PORT=8080
PHPMYADMIN_PORT=8081

# Database credentials
WORDPRESS_DB_NAME=wordpress
WORDPRESS_DB_USER=wordpress
WORDPRESS_DB_PASSWORD=wordpress
MYSQL_ROOT_PASSWORD=rootpassword

# Enable/disable WordPress debug mode
WORDPRESS_DEBUG=1
```

## Common Commands

### Using the Helper Script

The `docker-helper.sh` script provides convenient shortcuts:

```bash
# Start services
./docker-helper.sh start

# Stop services
./docker-helper.sh stop

# Restart services
./docker-helper.sh restart

# View logs
./docker-helper.sh logs          # All services
./docker-helper.sh logs-wp       # WordPress only
./docker-helper.sh logs-db       # Database only

# Check status
./docker-helper.sh status

# Access container shells
./docker-helper.sh shell-wp      # WordPress bash
./docker-helper.sh shell-db      # MySQL shell

# Reset environment (WARNING: removes all data)
./docker-helper.sh clean         # Clean up only
./docker-helper.sh reset         # Clean and restart
```

### Using Docker Compose Directly

### Start services
```bash
docker-compose up -d
```

### Stop services
```bash
docker-compose down
```

### View logs
```bash
# All services
docker-compose logs -f

# WordPress only
docker-compose logs -f wordpress

# MySQL only
docker-compose logs -f db
```

### Restart services
```bash
docker-compose restart
```

### Stop and remove all data (clean slate)
```bash
docker-compose down -v
```

**Warning:** The `-v` flag removes all volumes including the database and WordPress files!

## Development Workflow

### Theme Development

1. **Make changes to theme files:**
   - Edit files in your local repository
   - Changes are immediately reflected in the container

2. **Build assets:**
   ```bash
   npm install
   npm run watch  # Auto-rebuild on changes
   ```

3. **View changes:**
   - Refresh your browser at http://localhost:8080
   - Hard refresh (Ctrl+F5) if styles don't update

### Adding Content

Use the WordPress admin panel (http://localhost:8080/wp-admin) to:
- Create posts and pages
- Test theme features
- Configure theme settings via Customizer
- Install plugins if needed

### Database Management

Access phpMyAdmin at http://localhost:8081 to:
- Browse database tables
- Run SQL queries
- Export/import database
- Backup your data

## Troubleshooting

### Port already in use

If port 8080 or 8081 is already in use:

1. Edit `.env` file and change ports:
   ```bash
   WORDPRESS_PORT=8090
   PHPMYADMIN_PORT=8091
   ```

2. Restart Docker Compose:
   ```bash
   docker-compose down
   docker-compose up -d
   ```

### Cannot connect to database

1. Wait a moment for MySQL to fully start:
   ```bash
   docker-compose logs db
   ```

2. If issues persist, restart services:
   ```bash
   docker-compose restart
   ```

### WordPress installation loop

If WordPress keeps asking for installation:

1. Check if database connection is working:
   ```bash
   docker-compose logs wordpress
   ```

2. Verify database credentials in `.env` file

3. Try removing and recreating containers:
   ```bash
   docker-compose down
   docker-compose up -d
   ```

### Theme not appearing

1. Verify theme is mounted correctly:
   ```bash
   docker-compose exec wordpress ls -la /var/www/html/wp-content/themes/
   ```

2. Check theme files are present:
   ```bash
   docker-compose exec wordpress ls -la /var/www/html/wp-content/themes/vdaily-theme/
   ```

3. Restart WordPress container:
   ```bash
   docker-compose restart wordpress
   ```

### Permission issues

If you encounter permission issues:

```bash
# Fix permissions for uploads directory
docker-compose exec wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads
```

## Data Persistence

The following data is persisted in Docker volumes:

- **wordpress_data**: WordPress installation files
- **wordpress_uploads**: Uploaded media files
- **db_data**: MySQL database

These volumes persist even when containers are stopped. To completely remove all data:

```bash
docker-compose down -v
```

## Production Considerations

This Docker setup is designed for **development only**. Do not use it in production!

For production deployment:
- Use a production-ready hosting solution
- Follow WordPress security best practices
- Disable debug mode
- Use strong passwords
- Enable HTTPS
- Regular backups

## Tips

1. **Keep containers running:** Once started, you can keep containers running in the background while developing

2. **Use watch mode:** Run `npm run watch` to automatically rebuild assets when files change

3. **Test different content:** Create various post types (code samples, long articles, short posts) to test theme features

4. **Check responsive design:** Use browser dev tools to test mobile and tablet views

5. **Test performance:** Use WordPress plugins or browser tools to check loading times

## Clean Up

To completely remove the Docker environment:

```bash
# Stop containers and remove volumes
docker-compose down -v

# Remove images (optional)
docker rmi wordpress:6.4-php8.2-apache mysql:8.0 phpmyadmin:latest
```

## Getting Help

- **Docker issues:** Check Docker logs with `docker-compose logs`
- **WordPress issues:** Enable WP_DEBUG in `.env` and check logs
- **Theme issues:** See main README.md for theme documentation
