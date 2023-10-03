# Библиотека для создания консольных команд

### Установка
```
composer install
```

### Запуск
Для библиотеки нужно указать путь к дериктории с командами. После этого команду можно запустить по её названию.
```
$lib = new CommandLibrary('path/to/Commands');
$lib->startCommand('command_name');
```

### Регистрация команд
Для регистрации команды нужно наследовать класс от `Command` и указать дефолтное имя.
```
class ExampleCommand extends Command
    
    protected static $defaultName = 'example';
```
