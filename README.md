# TimeSlotPicker
Made with love by ItsKev1

## About the project
On the ongoing COVID 19 pandemic that has devastated the world, Indonesian supermarkets have not implemented such system that reduces the amount of people in the store at one time. Therefore, I have created this to reduce the spread of covid 19, which has already overwhelmed hospitals. With this implemented, everyone will need to book a slot before buying it.

## Features
- Displays how many slots remaining
- Select up to 3 days ahead
- Admin page

## To do list
- Make opening and end time configurable
- Make number of slots configurable
- Use JSON files for the parameters
- See issues for bugs and enhancements

## Presquites
- PHP 7.2
- Apache / Nginx
- The latest version of MySQL
- (Optional) PHPMyAdmin

### How to install
1. Install the presquites
2. Place all the files on apache2 folder
3. Import the MySQL database
4. Edit the database.php to match with your mysql database and credentials
5. Add a admin user in users database, use sha1 for salt.

## Config
- `open_time` Open time of the shop in HH:MM:SS
- `close_time` Closed time of the shop in HH:MM:SS
- `capacity` Capacity of the shop allowed in 1 hour




## Build with
- HTML5UP - the template used
