# Simple shop API using PHP + Symfony 4.3

## To execute application run:
* **sudo make first-init**
* **sudo execute-bash**

### Inside executed bash run:
* **mkdir -p config/jwt**
* **openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096**
* **openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout** 

To oped API documentation follow the route **127.0.0.1:8087/api/doc**