SELECT 
COUNT(*) AS NoOfRows
FROM PCTP_UNIFIED X WITH (NOLOCK)  
 WHERE  ( U_BookingDate <= CONVERT(date, '2024-01-19'))  AND  ( U_PTFNo = 'PTF2023-4784') 