# MYTHERESA_CODE_CHALENGE

This is a REST API written in PHP that is based on MVC . This api uses mysql and a php server. The project uses htaccess to route URLs to a bootstrap that sanitises the url params and maps the params to the corresponding controller and model as requested by the user.
This structure helps in extending the application as more endpoints can be added.

I decided to use mysql because of its performance and ease of use as the data increases.
T decided to use two tables with the following structure

Products Table
ID
Name
Sku
Category_id
Price
createdon
apdatedon

I felt that fetching using the category_id would be faster than mapping a whole string. 

Category Table
ID
name
createdon
updatedon


SETUP

Create a database and import the sql dump called mytheresa in database.
Copy paste the app into the root folder of a php webserver.
Set up the database configuration and path from psystem/config

just go to 
http://localhost/products?cat_id=1
http://localhost/products?cat_id=2&priceLessThan=3000

FUTURE EXTENSIONS

Intergrate a redis cache to help with the application speed

