import pusher from "@/channels/pusher";

function subscribeToChannel(channel_name, channel_event, expression) {
  const channel = pusher.subscribe(channel_name);
  channel.bind('pusher:subscription_succeeded', function() {
    console.log('Subscription to ' + channel_name + ' succeeded.');
  });
  channel.bind(channel_event, function(data) {
    expression(data);
  });
  return channel;
}

export default subscribeToChannel;
