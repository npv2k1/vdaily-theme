#!/bin/bash
# VDaily Theme - Docker Development Helper Script
# This script provides shortcuts for common Docker operations

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

print_header() {
    echo -e "${GREEN}========================================${NC}"
    echo -e "${GREEN}  VDaily Theme - Docker Helper${NC}"
    echo -e "${GREEN}========================================${NC}"
}

print_usage() {
    echo "Usage: ./docker-helper.sh [command]"
    echo ""
    echo "Commands:"
    echo "  start       - Start all services"
    echo "  stop        - Stop all services"
    echo "  restart     - Restart all services"
    echo "  logs        - Show logs (all services)"
    echo "  logs-wp     - Show WordPress logs only"
    echo "  logs-db     - Show database logs only"
    echo "  status      - Show status of all services"
    echo "  clean       - Stop and remove all containers and volumes (WARNING: removes all data!)"
    echo "  reset       - Clean and restart (fresh installation)"
    echo "  shell-wp    - Open bash shell in WordPress container"
    echo "  shell-db    - Open MySQL shell in database container"
    echo "  install     - Run initial setup (copy .env and start services)"
    echo "  help        - Show this help message"
}

check_env() {
    if [ ! -f .env ]; then
        echo -e "${YELLOW}No .env file found. Creating from .env.example...${NC}"
        cp .env.example .env
        echo -e "${GREEN}.env file created successfully!${NC}"
    fi
}

case "${1:-help}" in
    start)
        print_header
        check_env
        echo "Starting Docker services..."
        docker-compose up -d
        echo -e "${GREEN}Services started!${NC}"
        echo "WordPress: http://localhost:$(grep WORDPRESS_PORT .env | cut -d '=' -f2)"
        echo "phpMyAdmin: http://localhost:$(grep PHPMYADMIN_PORT .env | cut -d '=' -f2)"
        ;;
    
    stop)
        print_header
        echo "Stopping Docker services..."
        docker-compose down
        echo -e "${GREEN}Services stopped!${NC}"
        ;;
    
    restart)
        print_header
        echo "Restarting Docker services..."
        docker-compose restart
        echo -e "${GREEN}Services restarted!${NC}"
        ;;
    
    logs)
        docker-compose logs -f
        ;;
    
    logs-wp)
        docker-compose logs -f wordpress
        ;;
    
    logs-db)
        docker-compose logs -f db
        ;;
    
    status)
        print_header
        docker-compose ps
        ;;
    
    clean)
        print_header
        echo -e "${RED}WARNING: This will remove all containers and volumes (including database)!${NC}"
        read -p "Are you sure? (yes/no): " confirm
        if [ "$confirm" = "yes" ]; then
            echo "Cleaning up..."
            docker-compose down -v
            echo -e "${GREEN}Cleanup complete!${NC}"
        else
            echo "Cancelled."
        fi
        ;;
    
    reset)
        print_header
        echo -e "${RED}WARNING: This will reset everything to a fresh installation!${NC}"
        read -p "Are you sure? (yes/no): " confirm
        if [ "$confirm" = "yes" ]; then
            echo "Resetting..."
            docker-compose down -v
            check_env
            docker-compose up -d
            echo -e "${GREEN}Reset complete! WordPress is starting...${NC}"
            echo "WordPress: http://localhost:$(grep WORDPRESS_PORT .env | cut -d '=' -f2)"
            echo "phpMyAdmin: http://localhost:$(grep PHPMYADMIN_PORT .env | cut -d '=' -f2)"
        else
            echo "Cancelled."
        fi
        ;;
    
    shell-wp)
        docker-compose exec wordpress bash
        ;;
    
    shell-db)
        docker-compose exec db mysql -u root -p
        ;;
    
    install)
        print_header
        check_env
        echo "Installing and starting services..."
        docker-compose up -d
        echo -e "${GREEN}Installation complete!${NC}"
        echo ""
        echo "Next steps:"
        echo "1. Open http://localhost:$(grep WORDPRESS_PORT .env | cut -d '=' -f2)"
        echo "2. Complete WordPress installation"
        echo "3. Go to Appearance → Themes"
        echo "4. Activate 'VDaily Tech Blog Theme'"
        ;;
    
    help|*)
        print_header
        print_usage
        ;;
esac
