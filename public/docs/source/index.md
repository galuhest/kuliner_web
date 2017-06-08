---
title: Kuliner App API Documentation

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---

# Welcome
Welcome to Kuliner App API documentation

# Development
Kuliner App WebApp is developed using Laravel PHP framework, AdminLTE2, JQuery, and Bootstrap.
## Models
Models are located on `App\`. Model validations can be seen on each models, in `rules()` function
## Migrate
To run migration, run `php artisan migrate`
## Seed
To run seeder, run `php artisan db:seed`, the login account is `test@admin.com` and password `adminadmin`

# Region
Territory in Kuliner application is arranged in this order region -> district -> area

## Create new Region

### HTTP Request
`POST regions/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    longitude | float | required |
    latitude | float | required |

## Display the specified region.

### HTTP Request
`GET regions/{region_id}`

## Update the specified region in storage.

### HTTP Request
`PUT regions/{region_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		name | string |  required  | 
    longitude | float | required |
    latitude | float | required |

## Remove the specified region from storage.

### HTTP Request
`DELETE regions/{region_id}`

# District
Territory in Kuliner application is arranged in this order region -> district -> area

## Create new District

### HTTP Request
`POST districts/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    region_id | integer | required, exists in regions |
    longitude | float | required |
    latitude | float | required |

## Display the specified district.

### HTTP Request
`GET districts/{district_id}`

## Update the specified district in storage.

### HTTP Request
`PUT districts/{district_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		name | string |  required  | 
   	region_id | integer | required, exists in regions |
    longitude | float | required |
    latitude | float | required |

## Remove the specified district from storage.

### HTTP Request
`DELETE districts/{district_id}`

# Area
Territory in Kuliner application is arranged in this order region -> district -> area

## Create new Area

### HTTP Request
`POST areas/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    district_id | integer | required, exists in districts |
    longitude | float | required |
    latitude | float | required |

## Display the specified area.

### HTTP Request
`GET areas/{area_id}`

## Update the specified area in storage.

### HTTP Request
`PUT areas/{area_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		name | string |  required  | 
   	district_id | integer | required, exists in districts |
    longitude | float | required |
    latitude | float | required |

## Remove the specified area from storage.

### HTTP Request
`DELETE areas/{area_id}`



# Outlet Type
Outlet Type is the type of an outlet, for example "Kedai Makanan", "Toko Kelontong", "Cafe", etc.

## Create new Outlet Type

### HTTP Request
`POST outlet-types/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 

## Display the specified resource.

### HTTP Request
`GET outlet-types/{outlet_type_id}`

## Update the specified resource in storage.

### HTTP Request
`PUT outlet-types/{outlet_type_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 

## Remove the specified resource from storage.

### HTTP Request
`DELETE outlet-types/{outlet_type_id}`

# Product Type
Product Type is the type of an product, for example: "Makanan", "Minuman", "Paket", etc.

## Create new Product Type

### HTTP Request
`POST product-types/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 

## Display the specified product type.

### HTTP Request
`GET product-types/{product_type_id}`

## Update the specified product type in storage.

### HTTP Request
`PUT product-types/{product_type_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 

## Remove the specified product type from storage.

### HTTP Request
`DELETE product-types/{product_type_id}`

# Outlet
Outlet is sellers of products, it can be "Kedai", "Toko", or etc.

## Create new Outlet

### HTTP Request
`POST outlets/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    outlet_type_id | integer |  required, exists in outlet_types  | type of the outlet
    area_id | integer | required, exists in areas | area where the outlet is located
    longitude | float | required | outlet location in relation to longitude point
    latitude | float | required | outlet location in relation to latitude point
    status | boolean | required | whether outlet is active or not
    is_favourite | boolean | required |

## Display the specified outlet.

### HTTP Request
`GET outlet/{outlet_id}`

## Update the specified outlet in storage.

### HTTP Request
`PUT outlets/{outlet_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    outlet_type_id | integer |  required, exists in outlet_types  | type of the outlet
    area_id | integer | required, exists in areas | area where the outlet is located
    longitude | float | required | outlet location in relation to longitude point
    latitude | float | required | outlet location in relation to latitude point
    status | boolean | required | whether outlet is active or not
    is_favourite | boolean | required |

## Remove the specified outlet from storage.

### HTTP Request
`DELETE outlets/{outlet_id}`

# Product
Product is items that an outlet sells. There is no "price" field in Product table, because price of a product can be changed time to time, See `Price`

## Create new Product

### HTTP Request
`POST products/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    outlet_id | numeric |  required, exists in outlets  | 
    name | string | required | 
    product_type_id | numeric | required | type of a product
    product_group_id | numeric | required | group of a product in the outlet
		is_favourite | boolean | required 

## Display the specified product.

### HTTP Request
`GET products/{product_id}`

## Update the specified product in storage.

### HTTP Request
`PUT products/{product_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    outlet_id | numeric |  required, exists in outlets  | 
    name | string | required | 
    product_type_id | numeric | required | type of a product
    product_group_id | numeric | required | group of a product in the outlet
		is_favourite | boolean | required 

## Remove the specified product from storage.

### HTTP Request
`DELETE products/{product_id}`

## Get current price of the product
`getCurrentPrice($date)`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		date | date | optional | default value of $date is today

# Order
Order has many OrderDetail, to create / update orders pass JSON-object with arrays of details

#### Example:
```
{
	"outlet_id": "1",
	"date": "01/01/2017",
	...
	"details": [
		{
			"product_id": "1",
			"quantity": "3"
		}, {
			"product_id": "2",
			"quantity": "5"
		}
	]
}
```

## Create new Order

### HTTP Request
`POST orders/`

#### Parameters

##### Order 
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    outlet_id | integer |  required, exists in outlets  | outlet to where the order is made
    customer_id | id | required, exists in users | customer who make the order
    date | date | required |
    infaq | integer | optional | default value = 0
    paid_amount | integer | optional | default value = 0
    delivery_time | date | optional |
    status | integer | optional | default = 0

##### Order Detail
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    order_id | integer |  required, exists in orders |
    product_id | integer | required, exists in products |
    quantity | integer | required | default value = 1, minimal = 1

## Display the specified order.

### HTTP Request
`GET orders/{order_id}`

## Update the specified order in storage.

### HTTP Request
`PUT orders/{order_id}`

#### Parameters

##### Order
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    outlet_id | integer |  required, exists in outlets  | outlet to where the order is made
    customer_id | id | required, exists in users | customer who make the order
    date | date | required |
    infaq | integer | optional | default value = 0
    paid_amount | integer | optional | default value = 0
    delivery_time | date | optional |
    status | integer | optional | default = 0

##### Order Detail
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    order_id | integer |  required, exists in orders |
    product_id | integer | required, exists in products |
    quantity | integer | required | default value = 1, minimal = 1

## Remove the specified order from storage.

### HTTP Request
`DELETE orders/{order_id}`

# User
User in the application

## Create new User

### HTTP Request
`POST users/`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required, unique  |
    password | string | required | will be encrypted when storing it to database
    name | string | required |
    phone_number | numeric | required
    address | string | required
    role | integer | required | "customer" = 0, "member" = 1, "courier" = 2, "admin" = 3
    status | boolean | required |

## Display the specified user.

### HTTP Request
`GET users/{user_id}`

## Update the specified user in storage.

### HTTP Request
`PUT users/{user_id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		email | string |  required, unique  |
    password | string | required | will be encrypted when storing it to database
    name | string | required |
    phone_number | numeric | required
    address | string | required
    role | integer | required | "customer" = 0, "member" = 1, "courier" = 2, "admin" = 3
    status | boolean | required |

## Remove the specified user from storage.

### HTTP Request
`DELETE users/{user_id}`

## generate activation code
`generateActivationCode()`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		no parameter | | |

## Activate a user (status become active)
`activate($activation_code)`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		activation_code | string | required | 

## Generate member activation code
`generateMemberActivationCode()`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		no parameter | | |

## Activate a user (status become active)
`activateMember($member_activation_code)`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
		member_activation_code | string | required | 