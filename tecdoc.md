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

### Now we have the engines

#### The goal now is to grab the categories, need 15 category for the currently seeded engine

I currently suspect 3 tables involved

* tree_node_products (acting as pivot)
* search_trees (Has Description) but the name implies that it's not structural table
* products (also has Description & AssemblyGroupDescription)

There's no apparent link between engines & product categories

So let's look for the first category in the engine we have according to ghiar
the id is 100008

We can get the category name in search_trees with the id 100008

So I have 50864 and I need to find a way to get 100008
