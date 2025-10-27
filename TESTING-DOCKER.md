# Testing Docker Setup

This document provides step-by-step instructions to test the Docker Compose setup for the VDaily WordPress theme.

## Prerequisites Test

Before testing, ensure you have:

```bash
# Check Docker installation
docker --version
# Expected output: Docker version 20.x or higher

# Check Docker Compose installation
docker-compose --version
# Expected output: Docker Compose version 1.29.x or higher (or v2.x.x)

# Check if Docker is running
docker ps
# Should not show errors
```

## Test Procedure

### 1. Initial Setup

```bash
# Navigate to theme directory
cd /path/to/vdaily-theme

# Copy environment file
cp .env.example .env

# Verify .env file exists and contains correct values
cat .env
```

**Expected:** .env file should contain:
- WORDPRESS_PORT=8080
- PHPMYADMIN_PORT=8081
- Database credentials

### 2. Start Services

```bash
# Start Docker Compose services
docker-compose up -d

# Or use the helper script
./docker-helper.sh start
```

**Expected output:**
```
Creating network "vdaily-theme_vdaily-network" with driver "bridge"
Creating volume "vdaily-theme_wordpress_data"
Creating volume "vdaily-theme_wordpress_uploads"
Creating volume "vdaily-theme_db_data"
Creating vdaily-mysql ... done
Creating vdaily-wordpress ... done
Creating vdaily-phpmyadmin ... done
```

### 3. Check Services Status

```bash
# View running containers
docker-compose ps

# Or use helper script
./docker-helper.sh status
```

**Expected output:** All three services should be "Up":
- vdaily-wordpress (port 8080)
- vdaily-mysql (internal)
- vdaily-phpmyadmin (port 8081)

### 4. View Logs

```bash
# Check WordPress logs
docker-compose logs wordpress

# Check database logs
docker-compose logs db
```

**Expected:** No critical errors. MySQL should show "ready for connections"

### 5. Test WordPress Installation

1. **Open WordPress in browser:**
   ```
   http://localhost:8080
   ```

   **Expected:** WordPress installation page should appear

2. **Complete installation:**
   - Language: Select your preferred language
   - Site Title: "VDaily Test Site"
   - Username: "admin"
   - Password: Generate a strong password
   - Email: your-email@example.com
   - Click "Install WordPress"

   **Expected:** Success message and login prompt

3. **Login to WordPress Admin:**
   ```
   http://localhost:8080/wp-admin
   ```

   **Expected:** WordPress dashboard should load

### 6. Test Theme Activation

1. **Navigate to Themes:**
   - Go to Appearance → Themes
   
   **Expected:** "VDaily Tech Blog Theme" should be visible in the themes list

2. **Activate theme:**
   - Click "Activate" on VDaily Tech Blog Theme
   
   **Expected:** Theme activates successfully, no errors

3. **View site:**
   - Visit http://localhost:8080
   
   **Expected:** Site displays with VDaily theme styling

### 7. Test phpMyAdmin

1. **Open phpMyAdmin:**
   ```
   http://localhost:8081
   ```

2. **Login:**
   - Server: db
   - Username: root
   - Password: rootpassword (from .env)

   **Expected:** phpMyAdmin dashboard loads, shows "wordpress" database

3. **Browse database:**
   - Click on "wordpress" database
   - Check tables
   
   **Expected:** WordPress tables are visible (wp_posts, wp_users, etc.)

### 8. Test Theme Files

1. **Verify theme files are mounted:**
   ```bash
   docker-compose exec wordpress ls -la /var/www/html/wp-content/themes/vdaily-theme/
   ```

   **Expected:** Theme files should be listed (functions.php, style.css, etc.)

2. **Test hot-reload:**
   - Edit a theme file locally (e.g., add a comment to functions.php)
   - Check the file in container:
   ```bash
   docker-compose exec wordpress cat /var/www/html/wp-content/themes/vdaily-theme/functions.php | head -5
   ```

   **Expected:** Changes appear immediately

### 9. Test Development Workflow

1. **Create a test post:**
   - Go to Posts → Add New
   - Title: "Test Post with Code"
   - Content: Add some text and a code block
   - Publish

2. **View post:**
   - Visit the post on frontend
   
   **Expected:** Post displays correctly with theme styling

3. **Test code highlighting:**
   - Add code block with syntax highlighting
   
   **Expected:** Code appears with syntax highlighting

### 10. Test Helper Script Commands

```bash
# Test restart
./docker-helper.sh restart

# Test logs
./docker-helper.sh logs-wp

# Test status
./docker-helper.sh status
```

**Expected:** All commands work without errors

### 11. Test Cleanup (Optional)

⚠️ **Warning:** This will delete all data!

```bash
# Stop and remove everything
docker-compose down -v

# Or use helper script
./docker-helper.sh clean
```

**Expected:** All containers, networks, and volumes are removed

### 12. Test Fresh Start

```bash
# Start services again
docker-compose up -d
```

**Expected:** Fresh WordPress installation, theme still available

## Common Issues and Solutions

### Issue: Port 8080 already in use

**Solution:**
```bash
# Edit .env file
WORDPRESS_PORT=8090
PHPMYADMIN_PORT=8091

# Restart services
docker-compose down
docker-compose up -d
```

### Issue: Database connection error

**Solution:**
```bash
# Check database logs
docker-compose logs db

# Wait for database to fully start (usually 30-60 seconds)
# Then restart WordPress
docker-compose restart wordpress
```

### Issue: Theme not appearing

**Solution:**
```bash
# Verify theme is mounted
docker-compose exec wordpress ls -la /var/www/html/wp-content/themes/

# Check volume mounts
docker-compose config
```

### Issue: Permission errors

**Solution:**
```bash
# Fix permissions in container
docker-compose exec wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads
```

## Test Checklist

- [ ] Docker and Docker Compose are installed
- [ ] .env file created from .env.example
- [ ] Services start without errors
- [ ] All three containers are running
- [ ] WordPress accessible at http://localhost:8080
- [ ] WordPress installation completes successfully
- [ ] Can login to WordPress admin
- [ ] VDaily theme appears in themes list
- [ ] Theme activates successfully
- [ ] Site displays with theme styling
- [ ] phpMyAdmin accessible at http://localhost:8081
- [ ] Can browse database in phpMyAdmin
- [ ] Theme files are properly mounted
- [ ] Changes to theme files reflect in container
- [ ] Can create and view posts
- [ ] Helper script commands work
- [ ] Cleanup works correctly

## Success Criteria

✅ All items in the checklist above should be completed successfully

✅ No errors in container logs

✅ WordPress runs smoothly with the theme

✅ Database is accessible and functional

✅ Theme development workflow works as expected

## Performance Benchmarks

### Container Startup Time
- Expected: 30-60 seconds for all services to be ready
- Database should be "ready for connections" within 30 seconds
- WordPress should respond to requests within 60 seconds

### WordPress Response Time
- Initial page load: < 3 seconds
- Admin panel: < 2 seconds
- Theme activation: < 1 second

### Resource Usage
- Memory: ~500MB-1GB total for all containers
- CPU: Minimal when idle, spikes during operations

## Reporting Issues

If any tests fail, collect the following information:

1. **Environment:**
   ```bash
   docker --version
   docker-compose --version
   uname -a  # or system information
   ```

2. **Logs:**
   ```bash
   docker-compose logs > docker-logs.txt
   ```

3. **Container status:**
   ```bash
   docker-compose ps
   ```

4. **Error messages:** Copy any error messages from browser or terminal

5. **Steps to reproduce:** Document exact steps that caused the issue
