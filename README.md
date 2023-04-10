
# SoupFFA

[![](https://poggit.pmmp.io/shield.state/SoupFFA)](https://poggit.pmmp.io/p/SoupFFA)
[![](https://poggit.pmmp.io/shield.dl.total/SoupFFA)](https://poggit.pmmp.io/p/SoupFFA)

SoupFFA is a plugin designed to regenerate 3.5 hearts in Minecraft when players right-click on soup. This plugin is especially useful in Free-for-all (FFA) battles or PvP situations where players need to regenerate their health quickly during a fight.

When a player right-clicks on soup or stew item, the plugin will instantly regenerate 3.5 hearts of the player's health. The soup or stew item is then removed from the player's inventory, preventing them from using it again until they obtain another one.

SoupFFA is easy to install and use and works seamlessly with other plugins on your server. This plugin will enhance the gaming experience of your players by allowing them to focus on the battle instead of worrying about their health.

Overall, SoupFFA is a must-have plugin for any Minecraft server that features PvP gameplay. It's a great addition to any server that wants to make the game more enjoyable and engaging for players.

To download SoupFFA, simply head to the [release tab](https://github.com/AshiePleb/SoupFFA/releases/latest) and download the latest version. This plugin is compatible with PocketMine-MP API4 and is regularly updated to ensure optimal performance. Don't wait – take your Minecraft server to the next level and download SoupFFA today!

## Config

To enable or disable the plugin in certain worlds, add their names to the 'enabled-worlds' list below. SoupFFA will only work in worlds that are listed.

You can add as many worlds as you like to the list.

```yaml
enabled-worlds:
  - world
  - world1
  - world2
  - world3
```

This is the amount of health that will be restored when a player drinks a soup.

The default value is 3.5, which is the same as a golden apple.
```yaml
health-regen: 3.5
```

This is the message that will be displayed to the player when they drink a soup but are already at full health.
```yaml
full-health-message: "&aYou are already at full health!"
```

## Support

If you have any questions or issues, feel free to contact me on my [Discord server](https://discord.gg/SM7xE3pSK8), alternatively you can open an issue on the [GitHub repository](https://github.com/AshiePleb/SoupFFA/issues) and I will try respond as soon as possible.

## Contributors

I would like to thank the following people for their contributions to this project:

- [HBIDamian](https://github.com/HBIDamian)
- [Henry8K](https://github.com/Henry8K)