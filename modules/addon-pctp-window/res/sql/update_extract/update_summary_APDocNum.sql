-- PRINT 'BEFORE TRY'
-- BEGIN TRY
--     BEGIN TRAN
--     PRINT 'First Statement in the TRY block'

-------->>CREATING TARGETS
    
    DROP TABLE IF EXISTS TMP_TARGET
    SELECT

    T0.U_BookingNumber AS U_BookingNumber,
    CASE 
        WHEN TF.U_DocNum IS NULL OR TF.U_DocNum = '' THEN TF.U_Paid
        ELSE 
            CASE 
                WHEN TF.U_Paid IS NULL OR TF.U_Paid = '' THEN TF.U_DocNum 
                ELSE CONCAT(TF.U_DocNum, ', ', TF.U_Paid)
            END
    END AS U_APDocNum

    INTO TMP_TARGET

    FROM [dbo].[@PCTP_POD] T0  WITH (NOLOCK)
    LEFT JOIN TP_FORMULA TF ON TF.U_BookingId = T0.U_BookingNumber

-------->>SUMMARY_EXTRACT

    UPDATE SUMMARY_EXTRACT
    SET U_APDocNum = TMP.U_APDocNum
    FROM TMP_TARGET TMP
    WHERE TMP.U_BookingNumber = SUMMARY_EXTRACT.U_BookingNumber

-------->>DELETING TMP_TARGET

    DROP TABLE IF EXISTS TMP_TARGET

--     PRINT 'Last Statement in the TRY block'
--     COMMIT TRAN
-- END TRY
-- BEGIN CATCH
--     PRINT 'In CATCH Block'
--     IF(@@TRANCOUNT > 0)
--         ROLLBACK TRAN;

--     THROW; -- raise error to the client
-- END CATCH
-- PRINT 'After END CATCH'