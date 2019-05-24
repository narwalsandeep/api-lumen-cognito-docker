Lumen based Full RESTful API using AWS Cognito
-------------------------------------------------

- **signup**, signup with email and password
- **verify email/user**, verify user with code sent during signup process

- **signin**, signin with email and password
- **change password**, change password for logged in user

- **forgot password**, send email code to reset password
- **reset new password**, reset new password

This set of API runs on Docker Container.
Sourecode for Lumen and Docker files can be collected from below URL.

Setup .env config
--------------------
APP_NAME=Auth
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

AWS_KEY=
AWS_SECRET=
AWS_REGION=
AWS_VERSION=latest
AWS_APP_CLIENT_ID=
AWS_APP_CLIENT_SECRET=
AWS_USER_POOL_ID=


Building and runninng
------------------------

> docker-compose build

> docker-compose up

API should be running on http://localhost:9991

Import into Postman
----------------------

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/10fe8447be9d9e9350a9#?env%5BMicro-Local%5D=W3sia2V5Ijoic2VydmVyIiwidmFsdWUiOiJodHRwOi8vbG9jYWxob3N0Ojk5OTEiLCJlbmFibGVkIjp0cnVlfSx7ImtleSI6ImVtYWlsIiwidmFsdWUiOiJuYXJ3YWxzYW5kZWVwQGdtYWlsLmNvbSIsImVuYWJsZWQiOnRydWV9LHsia2V5IjoicGFzc3dvcmQiLCJ2YWx1ZSI6IjEyMzEyMyIsImVuYWJsZWQiOnRydWV9LHsia2V5IjoiY29kZSIsInZhbHVlIjoiNzc2NDYyIiwiZW5hYmxlZCI6dHJ1ZX0seyJrZXkiOiJ2ZXJpZmljYXRpb25fY29kZSIsInZhbHVlIjoiMDgxNjM3IiwiZW5hYmxlZCI6dHJ1ZX0seyJrZXkiOiJuZXdfcGFzc3dvcmQiLCJ2YWx1ZSI6IjEyMzEyMyIsImVuYWJsZWQiOnRydWV9LHsia2V5Ijoib2xkX3Bhc3N3b3JkIiwidmFsdWUiOiIxMjMxMjMiLCJlbmFibGVkIjp0cnVlfSx7ImtleSI6InRva2VuIiwidmFsdWUiOiJleUpyYVdRaU9pSnBhMFF4YzBaaUt6TjBUakZVUkV3NFMyaDZka2M0TkRrclFVNVdXVWd5TVhVeVN6UXdVbHd2TjBOT1VUMGlMQ0poYkdjaU9pSlNVekkxTmlKOS5leUp6ZFdJaU9pSTFZakUzTldaa01TMDFORGMxTFRRNFlUQXRZbUl3T1Mwd1l6VmhOelptTWpabE5qa2lMQ0psZG1WdWRGOXBaQ0k2SW1ZNU16WXhZVGhrTFRka1pqWXRNVEZsT1MxaFpUQTRMVE5pT1RFNFltUmtPVEJtWXlJc0luUnZhMlZ1WDNWelpTSTZJbUZqWTJWemN5SXNJbk5qYjNCbElqb2lZWGR6TG1OdloyNXBkRzh1YzJsbmJtbHVMblZ6WlhJdVlXUnRhVzRpTENKaGRYUm9YM1JwYldVaU9qRTFOVGcyT0RNMU16QXNJbWx6Y3lJNkltaDBkSEJ6T2x3dlhDOWpiMmR1YVhSdkxXbGtjQzUxY3kxM1pYTjBMVEl1WVcxaGVtOXVZWGR6TG1OdmJWd3ZkWE10ZDJWemRDMHlYMVZGYTNkMlNteDRPU0lzSW1WNGNDSTZNVFUxT0RZNE56RXpNQ3dpYVdGMElqb3hOVFU0Tmpnek5UTXdMQ0pxZEdraU9pSXdZalV6TmpRMFl5MDNaRFl3TFRRNU5EQXRZamxtTWkwNE16RTRZamxpTjJFek5tVWlMQ0pqYkdsbGJuUmZhV1FpT2lKclp6UnNPRzF4WkhRMk1XSjBhSEpzTkRFMVlXVmliakZoSWl3aWRYTmxjbTVoYldVaU9pSnVZWEozWVd4ellXNWtaV1Z3UUdkdFlXbHNMbU52YlNKOS5Qa3hCRG5SdVVKS0JZQmlVMDBocmlzX2lRcC1pSG1FNE9PRnFKdGRrTlduOXNHeU1pUEFkMWtVT1pHZ2dqVTdRdHBROHNpQlhab1lXbDZ5T0tzOWtjRHA0ZU82LTFlUXBzNVQ3QzNaWVd1R1Z4THprbHVaMXZNWXZ4d0FmQ3ljeXQ5NHFIQkdYanNoS0Z3Rl9PanJ3OE1TWDVXOFhYZTZqTTBXQWpELTZWOU9aSDItQUJDRnRyRVNaMmI5WlY0YkZKalh1VW9vSFlxVHJkR3AxTTJ4eUVRQzZfRHdwakFrY2UtOHpWakprSlMwaTNTTWsxLVdnWkotSGlORjN4X0tKUDFPekh0MHBSUWJXdkI1VmlmNllBWWQwREhIYmZ6S2ZPeFRPUFZ6MzhLUUppOVRfanRDU05ka3FPWTJ4bmdlWkRzVUpYc1RLdGppOHhZbDNvZVVVb2ciLCJlbmFibGVkIjp0cnVlfV0=)

API documentation and POSTMAN config can be downloaded from below
-------------------------------------------------------------------

https://documenter.getpostman.com/view/2201339/S1TPc1jR?version=latest
