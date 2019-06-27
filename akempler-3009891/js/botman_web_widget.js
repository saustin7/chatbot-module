/* old settings
var botmanWidget = {
  chatServer: '/botman/' + drupalSettings.botman.botman_route,
  frameEndpoint: '/botman/widget',
  title: drupalSettings.botman.header_title,
  aboutText: drupalSettings.botman.about_text,
  aboutLink: drupalSettings.botman.about_link,
  bubbleAvatarUrl: '/modules/akempler-3009891/src/eagle-ico.png',
  introMessage: drupalSettings.botman.intro_message,
  mainColor: '#' + drupalSettings.botman.header_bg_color,
  headerTextColor: '#' + drupalSettings.botman.header_text_color,
  bubbleBackground: '#A31F37',
  timeFormat: 'h:mm'
};
*/
/* Possible new settings */
var botmanWidget = {
  chatServer: '/modules/akempler-3009891/modules/examples/botman_helloworld/src/Plugin/BotmanChatbot/HelloWorldChatbot.php',
  frameEndpoint: '/botman/widget',
  title: drupalSettings.botman.header_title,
  aboutText: drupalSettings.botman.about_text,
  aboutLink: drupalSettings.botman.about_link,
  bubbleAvatarUrl: '/modules/akempler-3009891/src/eagle-ico.png',
  introMessage: drupalSettings.botman.intro_message,
  mainColor: '#' + drupalSettings.botman.header_bg_color,
  headerTextColor: '#' + drupalSettings.botman.header_text_color,
  bubbleBackground: '#A31F37',
  timeFormat: 'h:mm'
};
