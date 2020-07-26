# Match tecdoc DB

### We're trying to import data from TecDoc into our own database

### So we're keeping our structure and importing TecDoc

### First of all, let's get the brands

In our database, brands table looks like this

-   name
-   country
-   logo
-   slug

In TecDoc the brands table look like this

### Then the vehicles

In our database, vehicles table looks like this

-   id
-   year
-   brand_id => references brands table
