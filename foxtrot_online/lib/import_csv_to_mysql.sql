LOAD DATA LOCAL INFILE 'C:/Users/alonb/Desktop/FoxTrotOnline/foxtrot_online/lafferty/db/TradesTest3_20180801T090622.csv'
INTO TABLE trades
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n"
IGNORE 1 LINES;