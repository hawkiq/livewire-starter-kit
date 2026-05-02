# Config-Driven Sidebar Menu

This improvement introduces a **config-driven sidebar system** for the Laravel Livewire Starter Kit by hawkiq.

Instead of modifying Blade templates to change navigation items, the sidebar is now fully controlled from a configuration file.

This makes the menu:
- Easily customizable
- Role/permission aware
- Environment flexible
- Cleanly separated from UI logic
- Safe during framework updates

---

## ✨ Features

- Grouped navigation items
- Internal route support
- External link support
- Flux icon support
- FontAwesome icon support
- Permission-based visibility
- Theme toggle integration
- Fully compatible with Livewire navigation (`wire:navigate`)
- Compatible with the latest Flux sidebar structure

---
## Install

```
laravel new app-name --using=hawkiq/livewire-starter-kit
```

--- 

## 📂 Configuration

Sidebar items are defined in:

```
config/ui.php
```

Example:

```php
return [

    'theme_toggle' => true,
    'driver' => 'auto',

    'sidebar' => [

        [
            'type' => 'group',
            'text' => 'Platform',
            'items' => [
                [
                    'text' => 'Dashboard',
                    'url' => 'dashboard',
                    'icon' => 'home',
                    'permission' => null,
                ],
            ],
        ],

    ],

];
```

---

## 🧩 Menu Item Structure

### Required Fields

- `text` — Display label
- `url` — Route name, full URL, or path
- `icon` — Flux icon or FontAwesome class

### Optional Fields

- `type` — `group` or `link`
- `permission` — Permission string (based on configured driver)
- `target` — For external links (e.g. `_blank`)

---

## 🎨 Icon Support

### Flux Icons

If the icon does **not** start with:

```
fa
fas
far
fa-
```

It will be treated as a Flux icon.

Example:

```php
'icon' => 'home',
```

---

### FontAwesome Icons

Use full class names:

```php
'icon' => 'fas fa-users',
```

---

## 🔐 Permission Support

Visibility is controlled by the configured driver:

```php
'driver' => 'auto',
```

Supported drivers:
- auto
- laratrust
- spatie
- gate

If `permission` is `null`, the item is always visible.

---

## 🔗 URL Handling

The system automatically detects:

### Route Names

If the value does not start with:

- `http://`
- `https://`
- `/`
- `#`

It will attempt to resolve it using Laravel's `route()` helper.

Example:

```php
'url' => 'dashboard',
```

---

### External Links

```php
'url' => 'https://laravel.com',
```

These are rendered as external links.

---

### Raw Paths

```php
'url' => '/custom-page',
```

Used directly without route resolution.

---

## 🌙 Theme Toggle

Theme toggle can be enabled or disabled:

```php
'theme_toggle' => true,
```

It integrates with Flux dark mode.

---

## 🚀 Benefits

This approach:

- Removes hardcoded navigation from Blade
- Centralizes menu management in configuration
- Supports role-based access control
- Makes upgrades safer
- Improves maintainability
- Keeps UI clean and reusable

---

## 📌 Compatibility

Designed for:

- Laravel > 12.0
- Livewire > 3.5
- Flux UI > 2.0
- Livewire Starter Kit

---

## Summary

The Config-Driven Sidebar Menu transforms navigation into a fully configurable system, improving scalability, maintainability, and upgrade safety.


# Laravel + Livewire Starter Kit

## Introduction

Our Laravel + [Livewire](https://livewire.laravel.com) starter kit provides a robust, modern starting point for building Laravel applications with a Livewire frontend.

Livewire is a powerful way of building dynamic, reactive, frontend UIs using just PHP. It's a great fit for teams that primarily use Blade templates and are looking for a simpler alternative to JavaScript-driven SPA frameworks like React and Vue.

This Livewire starter kit utilizes Livewire 4, TypeScript, Tailwind, and the [Flux UI](https://fluxui.dev) component library.

If you are looking for the alternate configurations of this starter kit, they can be found in the following branches:

- [workos](https://github.com/laravel/livewire-starter-kit/tree/workos) - if WorkOS is selected for authentication

## Official Documentation

Documentation for all Laravel starter kits can be found on the [Laravel website](https://laravel.com/docs/starter-kits).

## Contributing

Thank you for considering contributing to our starter kit! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

All contributions to the Starter Kits from now on should be made through [Maestro](https://github.com/laravel/maestro).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel + Livewire starter kit is open-sourced software licensed under the MIT license.
