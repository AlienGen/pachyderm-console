# Pachyderm Console

[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

A simple and reliable console tool. Create CLI commands to execute code.

## ✨ Features

- **🔄 Auto-Discovery**: No need to register your commands
- **⚡ Zero Config**: Works out of the box
- **🤖 Easy Setup**: Simple command to set up the console structure

## 📋 Requirements

- **PHP**: 8.4 or higher
- **Composer**: For dependency management

## 🚀 Quick Start

### Installation

```bash
composer require aliengen/pachyderm-console
```

### Setup

After installation, run the setup command to create the necessary files:

```bash
./vendor/bin/pachyderm-console --setup
```

This will automatically create:
- `src/Commands/` folder for your commands files
- `console.php` file for easy execution

### Basic Usage

1. **Create a command** by adding a class to `src/Commands/`:

```php
<?php

namespace Src\Commands;

use Pachyderm\Console\CommandInterface;

class MyCommand implements CommandInterface
{

    public function __construct() {
    }
    public function getName(): string
    {
        return 'my-command';
    }

    public function getDescription(): string
    {
        return 'My custom command';
    }

    public function run(array $arguments = []): void
    {
        echo 'Message from my custom command'
    }
}
```

2. **Run commands** using any of these methods:

```bash
# Option 1: Using the generated migration.php file
php console.php [command name]

# Option 2: Using the vendor binary directly
./vendor/bin/pachyderm-console [command name]
```

That's it! Your migration will be executed and tracked automatically.

## 📚 Usage

Display all available commands using any of these methods:

```bash
# Using the generated file
php console.php

# Using the vendor binary
./vendor/bin/pachyderm-console
```

## 📁 Project Structure

```
your-project/
├── src/
│   └── Commands/
│       ├── MyCommand.php
│       ├── MyOtherCommand.php
├── vendor/                  # Composer dependencies
├── console.php              # Console execution script
└── composer.json
```

## 🤝 Contributing

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

- **Issues**: [GitHub Issues](https://github.com/aliengen/pachyderm-console/issues)

---

**Made with ❤️ by the AlienGen team**
