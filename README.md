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


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
