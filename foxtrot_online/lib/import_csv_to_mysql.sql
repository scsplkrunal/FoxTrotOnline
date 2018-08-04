LOAD DATA LOCAL INFILE 'C:/Users/alonb/Desktop/FoxTrotOnline/foxtrot_online/company_a/db/prodtype.csv'
INTO TABLE prodtype
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n"
IGNORE 1 LINES;