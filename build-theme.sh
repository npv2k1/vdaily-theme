#!/bin/bash

# Build and package theme for release
# This script creates a clean theme archive suitable for WordPress installation

set -e

echo "=== VDaily Theme Release Builder ==="
echo ""

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Get version from command line or use default
VERSION="${1:-dev}"
THEME_NAME="vdaily-theme"
ARCHIVE_NAME="${THEME_NAME}-${VERSION}"
BUILD_DIR="build"

echo -e "${BLUE}Building theme version: ${VERSION}${NC}"
echo ""

# Step 1: Clean previous builds
echo "Step 1: Cleaning previous builds..."
rm -rf "${BUILD_DIR}"
mkdir -p "${BUILD_DIR}"

# Step 2: Install dependencies and build
echo ""
echo "Step 2: Installing dependencies..."
npm ci

echo ""
echo "Step 3: Building production assets..."
npm run build

# Step 4: Create clean theme directory
echo ""
echo "Step 4: Creating clean theme archive..."
TEMP_DIR="${BUILD_DIR}/${THEME_NAME}"
mkdir -p "${TEMP_DIR}"

# Copy only theme files (exclude development and git files)
rsync -av --progress \
  --exclude='.git' \
  --exclude='.github' \
  --exclude='.gitignore' \
  --exclude='.dockerignore' \
  --exclude='.env*' \
  --exclude='.vscode' \
  --exclude='.specify' \
  --exclude='node_modules' \
  --exclude='specs' \
  --exclude='src' \
  --exclude='package.json' \
  --exclude='package-lock.json' \
  --exclude='webpack.config.js' \
  --exclude='docker-compose*.yml*' \
  --exclude='docker-helper.sh' \
  --exclude='DOCKER.md' \
  --exclude='TESTING-DOCKER.md' \
  --exclude='SCREENSHOT.md' \
  --exclude='build' \
  --exclude='build-theme.sh' \
  --exclude='*.map' \
  ./ "${TEMP_DIR}/"

# Step 5: Create zip archive
echo ""
echo "Step 5: Creating zip archive..."
cd "${BUILD_DIR}"
zip -r "${ARCHIVE_NAME}.zip" "${THEME_NAME}" -q
cd ..

# Step 6: Display results
echo ""
echo -e "${GREEN}=== Build Complete ===${NC}"
echo ""
echo "Archive created: ${BUILD_DIR}/${ARCHIVE_NAME}.zip"
echo ""
echo "Archive contents:"
unzip -l "${BUILD_DIR}/${ARCHIVE_NAME}.zip" | head -20
echo ""
echo "Archive size:"
du -h "${BUILD_DIR}/${ARCHIVE_NAME}.zip"
echo ""
echo -e "${GREEN}Ready for WordPress installation!${NC}"
echo ""
echo "To test: Upload ${BUILD_DIR}/${ARCHIVE_NAME}.zip to WordPress Admin > Appearance > Themes > Add New > Upload Theme"
