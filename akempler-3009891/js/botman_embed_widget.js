var messages = [
  {
    from: drupalSettings.botman.embed_widget.chatbot_name,
    chatbot_name: drupalSettings.botman.embed_widget.chatbot_name,
    text: 'Welcome',
    buttons: []
  }
];
var app = new Vue({
  el: '#app-messages',
  data: {
    messages: messages
  },
  updated: function () {
    $("#app-messages").scrollTop($("#app-messages")[0].scrollHeight);
  }
});
var appForm = new Vue({
  el: '#app-form',
  methods: {
    // Handles a character being typed into the input box
    keyPress: function (event) {
      if (event.target.value == '') {
        //No text is present, so disabled the 'Send' button
        $('#message-send').attr('disabled', 'disabled');
      }
      else {
        $('#message-send').removeAttr('disabled');
      }
    },
    // Sends the message to the bot, and displays the response
    send: function (event) {
      event.preventDefault();
      var message = $('#message-input').val();
      //Add the sent message to the message list
      messages.push({from: 'You', text: message});
      // Clear the inputs
      $('#message-input').val('');
      $('#message-send').attr('disabled', 'disabled');
      //Build up the form data
      const data = new FormData();
      data.append('driver', 'web');
      data.append('message', message);
      //Send the message
      axios.post('/botman/' + drupalSettings.botman.botman_route, data).then(function (response) {
        // Add the response to the messages array\
        var button_actions = [];
        if (response.data.messages[0].type == 'actions') {
          response.data.messages[0].actions.forEach(function (button) {
            button_actions.push({text: button.text, value: button.value});
          });
        }

        messages.push({
          from: drupalSettings.botman.embed_widget.chatbot_name,
          chatbot_name: drupalSettings.botman.embed_widget.chatbot_name,
          text: response.data.messages[0].text,
          buttons: button_actions
        });
      });
    }
  }
});