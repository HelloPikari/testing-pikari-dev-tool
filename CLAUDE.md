# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

test-tooling is a WordPress plugin that This is a test.

## Development Commands

### Build and Development

```bash
# Install dependencies
npm install
composer install

# Start development build with file watching
npm start

# Production build
npm run build

# Create plugin ZIP for distribution
npm run plugin-zip
```

### Code Quality

```bash
# Run all linting
npm run lint:all

# Auto-fix linting issues
npm run lint:fix

# Run PHP linting only
npm run lint:php

# Run JavaScript linting only
npm run lint:js

# Run CSS linting only
npm run lint:css
```

### Testing

```bash
# Run JavaScript tests
npm test

# Run PHP tests
composer test
```

### WordPress Playground

```bash
# Start local WordPress Playground
npm run playground
```

## Coding Standards

### PHP Coding Standards

-   Follow WordPress Coding Standards with **4 spaces indentation (NOT TABS)**
-   This project's phpcs.xml enforces space-based indentation
-   Use meaningful function and variable names with underscores (not camelCase)
-   Prefix all global functions with your plugin/theme prefix
-   Document all functions with proper PHPDoc blocks
-   Use WordPress functions when available (e.g., `wp_remote_get()` instead of `curl`)

### JavaScript Standards

-   Use WordPress ESLint configuration
-   Single quotes for strings
-   Space indentation as configured in .eslintrc.cjs
-   Meaningful variable names in camelCase
-   Use `wp` global for WordPress JavaScript APIs

### CSS/SCSS Standards

-   Follow WordPress CSS coding standards
-   Use semantic, descriptive class names
-   Prefix all CSS classes with your plugin/theme prefix
-   Mobile-first responsive design
-   Use CSS custom properties for theme compatibility

### HTML Standards

-   Use semantic HTML5 elements
-   Ensure proper accessibility (ARIA labels, alt text, etc.)
-   Follow WordPress HTML coding standards
-   Validate HTML output

### Database Queries

-   Use WordPress database APIs (`$wpdb`)
-   Always prepare SQL queries to prevent injection
-   Cache expensive queries using transients
-   Follow WordPress database schema conventions

### Code Style and Linting

**IMPORTANT**: All generated code MUST follow the linting configurations defined in this project:

-   **PHP**: Use 4 spaces for indentation (NO TABS) - see phpcs.xml
-   **JavaScript**: Follow ESLint + Prettier configuration
-   **CSS/SCSS**: Follow Stylelint configuration
-   Generated code must pass all linting checks without modifications

### General Principles

-   Write clean, readable, and maintainable code
-   Follow the principle of least surprise
-   Prefer clarity over cleverness
-   Use meaningful variable and function names
-   Keep functions small and focused on a single responsibility
-   Comment complex logic, not obvious code
-   Maintain consistent formatting (enforced by linters)

### Documentation

-   Document all public APIs
-   Include examples in documentation
-   Keep documentation up-to-date with code changes
-   Use inline comments sparingly and only when necessary

### Error Handling

-   Always handle errors appropriately
-   Provide meaningful error messages
-   Log errors for debugging but don't expose sensitive info
-   Fail fast and fail clearly

### Performance

-   Optimize for readability first, performance second
-   Profile before optimizing
-   Avoid premature optimization
-   Consider caching for expensive operations

## Architecture

### Project Structure

-   `test-tooling.php` - Main plugin/theme file with WordPress headers
-   `includes/` - PHP classes and core functionality (PSR-4 autoloaded)
-   `src/` - JavaScript and SCSS source files
-   `build/` - Compiled assets (gitignored, created by build process)
-   `languages/` - Translation files (.pot, .po, .mo)
-   `tests/` - Unit and integration tests
-   `bin/` - Utility scripts (e.g., release automation)
-   `_playground/` - WordPress Playground configuration

### Key WordPress Patterns

-   Use WordPress hooks: `add_action()`, `add_filter()`, `remove_action()`, `remove_filter()`
-   Enqueue scripts and styles properly using `wp_enqueue_script()` and `wp_enqueue_style()`
-   Register scripts/styles first with `wp_register_script()` when reusing
-   Use WordPress APIs for all operations (database, HTTP requests, filesystem)
-   Follow WordPress file naming conventions
-   Use WordPress template hierarchy for themes

### Dependencies

-   WordPress 6.0
-   PHP 8.2
-   Node.js for build tools
-   Composer for PHP dependencies

## Git Workflow

-   Main branch: `main`
-   Feature branches: `feature/description`
-   Bugfix branches: `fix/description`
-   Commit format: `type: Brief description`
    -   Types: feat, fix, docs, style, refactor, test, chore
-   Pre-commit hooks run linting automatically via Husky
-   All commits must pass linting

## Testing

-   JavaScript tests in `tests/unit/`
-   PHP tests in `tests/` following PHPUnit structure
-   Run all tests before submitting PR
-   Write tests for new features and bug fixes
-   Aim for good test coverage

## Security Considerations

### WordPress Security Best Practices

#### Output Escaping

-   `esc_html()` - For plain text output
-   `esc_attr()` - For HTML attribute values
-   `esc_url()` - For URLs
-   `esc_js()` - For inline JavaScript (deprecated, avoid inline JS)
-   `wp_kses_post()` - For content with allowed HTML
-   `esc_textarea()` - For textarea content

#### Input Sanitization

-   `sanitize_text_field()` - For plain text input
-   `sanitize_email()` - For email addresses
-   `sanitize_url()` - For URLs
-   `sanitize_key()` - For keys and slugs
-   `wp_kses_post()` - For content with HTML
-   `absint()` - For positive integers
-   `intval()` - For integers

#### Nonces

-   Always use nonces for forms and AJAX requests
-   `wp_nonce_field()` - Add nonce to forms
-   `check_admin_referer()` - Verify nonce in admin
-   `wp_verify_nonce()` - Verify nonce programmatically

#### Capabilities

-   Always check user capabilities before operations
-   `current_user_can()` - Check if user has capability
-   Use appropriate capabilities (e.g., 'edit_posts', 'manage_options')
-   Never check for roles directly, always use capabilities

#### SQL Security

-   Use `$wpdb->prepare()` for all queries with variables
-   Never concatenate user input into SQL
-   Use WordPress query functions when possible
-   Validate and sanitize all database inputs

### Input Validation

-   Never trust user input
-   Validate all input on the server side
-   Use allowlists over blocklists when possible
-   Validate data type, length, format, and range

### Output Escaping

-   Escape all output based on context
-   Escape late (right before output)
-   Use context-appropriate escaping functions

### Authentication & Authorization

-   Check user permissions before any sensitive operation
-   Use secure session management
-   Implement proper access controls
-   Never store passwords in plain text

### Data Protection

-   Use HTTPS for all communications
-   Encrypt sensitive data at rest
-   Follow the principle of least privilege
-   Never commit secrets or API keys to version control
-   Use environment variables for sensitive configuration

### Dependencies

-   Keep all dependencies up to date
-   Regularly audit dependencies for vulnerabilities
-   Only use trusted packages from reputable sources
-   Review dependency licenses for compatibility

## Important Notes

-   This project uses Husky for pre-commit hooks
-   All PRs must pass CI checks (linting, tests, build)
-   The `build/` folder is gitignored but required for the plugin to function
-   Releases are created from the `build` branch which includes compiled assets
-   Compatible with WordPress 6.0+
-   Requires PHP 8.2+
-   Uses `@wordpress/scripts` for build tooling
-   Follow WordPress plugin/theme guidelines for wordpress.org submission

## Release Process

See bin/release.sh for automated release process

## WordPress-Specific Guidelines

### Block Editor (Gutenberg)

-   Use `@wordpress/*` packages for block editor functionality
-   Register blocks properly with `register_block_type()`
-   Provide block.json for block metadata
-   Support WordPress core blocks where applicable

### Internationalization

-   All user-facing strings must be translatable
-   Use proper text domains: `__()`, `_e()`, `_n()`, `_x()`, etc.
-   Text domain must match plugin/theme slug
-   Generate .pot files for translators

### Performance

-   Minimize database queries
-   Use object caching when available
-   Lazy load assets and functionality
-   Follow WordPress performance best practices

### Backwards Compatibility

-   Maintain compatibility with supported WordPress versions
-   Check for function existence when using newer functions
-   Provide graceful degradation

## Quick Reference

### Common WordPress Functions

```php
// Escaping
esc_html( $text )
esc_attr( $text )
esc_url( $url )
wp_kses_post( $content )

// Sanitization
sanitize_text_field( $input )
sanitize_email( $email )
absint( $number )

// Capabilities
current_user_can( 'edit_posts' )
current_user_can( 'manage_options' )

// Nonces
wp_nonce_field( 'action_name' )
wp_verify_nonce( $_POST['_wpnonce'], 'action_name' )
```

### WP-CLI Commands

```bash
# Useful during development
wp cache flush
wp rewrite flush
wp cron run --all
```
