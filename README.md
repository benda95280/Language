# MultiLanguage support for PocketMine
Language api for PMMP

## Commands available:

```TXT
/language list
  Show all language availaible
/ language <LanguageName>
  Define the language for that player
```

## ¿How it works?
```TXT
The file 'config.yml' contain your language available in your server
the file 'languages.yml' contain players language configuration
  (This file is created on first usage of the command to set the language)
```

## ¿How to use the API?

- Load Language Plugin:
```PHP
$languageManager = self::getInstance()->getServer()->getPluginManager()->getPlugin("Language");
```
- Functions of Language API:
```PHP
$langOfPlayer = $languageManager->getLanguage($player); // return String (ex: 'en_US')
```

## ¿How may i use it?

```TXT
- In your plugin, us the var $langOfPlayer to get the right language when sending message to player (Or item ...)
```

## Credits
This plugin create by **SharpyKurth**, edited by **Benda95280**
