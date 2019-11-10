create table if not exists big_table100 (id integer auto_increment primary key, 
col1 varchar(100),col2 varchar(100),col3 varchar(100),col4 varchar(100),col5 varchar(100),
col6 varchar(100),col7 varchar(100),col8 varchar(100),col9 varchar(100),col10 varchar(100),
col11 varchar(100),col12 varchar(100),col13 varchar(100),col14 varchar(100),col15 varchar(100),
col16 varchar(100),col17 varchar(100),col18 varchar(100),col19 varchar(100),col20 varchar(100),
col21 varchar(100),col22 varchar(100),col23 varchar(100),col24 varchar(100),col25 varchar(100),
col26 varchar(100),col27 varchar(100),col28 varchar(100),col29 varchar(100),col30 varchar(100),
col31 varchar(100),col32 varchar(100),col33 varchar(100),col34 varchar(100),col35 varchar(100),
col36 varchar(100),col37 varchar(100),col38 varchar(100),col39 varchar(100),col40 varchar(100),
col41 varchar(100),col42 varchar(100),col43 varchar(100),col44 varchar(100),col45 varchar(100),
col46 varchar(100),col47 varchar(100),col48 varchar(100),col49 varchar(100),col50 varchar(100),
col51 varchar(100),col52 varchar(100),col53 varchar(100),col54 varchar(100),col55 varchar(100),
col56 varchar(100),col57 varchar(100),col58 varchar(100),col59 varchar(100),col60 varchar(100),
col61 varchar(100),col62 varchar(100),col63 varchar(100),col64 varchar(100),col65 varchar(100),
col66 varchar(100),col67 varchar(100),col68 varchar(100),col69 varchar(100),col70 varchar(100),
col71 varchar(100),col72 varchar(100),col73 varchar(100),col74 varchar(100),col75 varchar(100),
col76 varchar(100),col77 varchar(100),col78 varchar(100),col79 varchar(100),col80 varchar(100),
col81 varchar(100),col82 varchar(100),col83 varchar(100),col84 varchar(100),col85 varchar(100),
col86 varchar(100),col87 varchar(100),col88 varchar(100),col89 varchar(100),col90 varchar(100),
col91 varchar(100),col92 varchar(100),col93 varchar(100),col94 varchar(100),col95 varchar(100),
col96 varchar(100),col97 varchar(100),col98 varchar(100),col99 varchar(100),col100 varchar(100));

delete from big_table100;

/* DROP PROCEDURE IF EXISTS sp_generate_data; */

DELIMITER //

CREATE PROCEDURE sp_generate_data(p1 INT, p2 INT)
  BEGIN
	SET @x = p1;
    REPEAT 
		INSERT INTO big_table100 (col1, col2, col3, col4, col5, col6, col7, col8, col9, col10, 
                col11, col12, col13, col14, col15, col16, col17, col18, col19, col20, 
                col21, col22, col23, col24, col25, col26, col27, col28, col29, col30, 
                col31, col32, col33, col34, col35, col36, col37, col38, col39, col40, 
                col41, col42, col43, col44, col45, col46, col47, col48, col49, col50, 
                col51, col52, col53, col54, col55, col56, col57, col58, col59, col60, 
                col61, col62, col63, col64, col65, col66, col67, col68, col69, col70, 
                col71, col72, col73, col74, col75, col76, col77, col78, col79, col80, 
                col81, col82, col83, col84, col85, col86, col87, col88, col89, col90, 
                col91, col92, col93, col94, col95, col96, col97, col98, col99, col100)
		VALUES (
			CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x), CONCAT("Ala ma kota ", @x)
		);
                SET @x = @x + 1;
	UNTIL @x > p2 
	END REPEAT;
  END;
//

DELIMITER ;
