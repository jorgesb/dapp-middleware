# Dapp consent tracking middleware

In order to keep the "smart contract" used by our blockchain as simple as posible, we have added a separate layer to the system. The idea is that instead of calling directly to the blockchain API, each request should go through our middleware, it will store in an auxiliar database some related keys, that will allow us to accomplish elaborated queries. In this way, we will be able to get all the transactions for an specific "uuid" or "opt id" without overloading the private network performance.

This middleware has been built using Symfony, providing an API with several endpoints to create and fetch records with information about consumer opt-in/opt-outs. It internally connects to the blockchain API described above.

First it creates a new record on his own database that will help on future searchs, later it call the blockchain endpoints to add a block with that information. If this second step fails, the new record will be removed from the database.

## Framework and DB

- Symfony 4.1: PHP framework used to build several endpoints and database CRUD
- MySQL
