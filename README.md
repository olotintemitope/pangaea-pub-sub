## How to install

- Run `vendor/bin/sail up` because we leverage docker for managing the application environment

## Create a topic
- You can use any of your favourite HTTP client to send a POST request via
  - `api/topic/create`
  
## Publish a topic
- You can publish a topic via 
  - `api/publish/{topic}`
  
## Subscribe to a topic
- The listening server can subscribe to any created topic via
  - `api/subscribe/{topic}`
  -  POST request

## How to test locally
This project leverages the redis pub/sub services. Since we are running the project
locally, the queue uses sync.

You will need to start the command to allow redis listen for connections
- Pick all subscribers to topic1 
  -- `php artisan redis:subscribe-topic1`
- Run the queue worker in case you want to use other queue drivers via 
  -- `php artisan queue:work redis --tries=3 --backoff=3`

- You can now publish the topic via `api/publish/{topic}`
- The only registered event for now is `topic1`. I will encourage you to create a topic with that slug
  

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
