CREATE OR REPLACE PROCEDURE NewAttendance(
  IN pEmployeePESEL VARCHAR(11)
)
BEGIN
    UPDATE attendances
    SET finished_at = CURRENT_TIMESTAMP
    WHERE employee_PESEL LIKE pEmployeePESEL
      AND finished_at is NULL;

    INSERT INTO attendances (employee_PESEL)
    VALUES (pEmployeePESEL);
END;

COMMIT;

CREATE OR REPLACE FUNCTION getProduced(
    pType VARCHAR(64),
    pFrom DATE,
    pTo DATE
)
RETURNS NUMERIC(10,2)
BEGIN
  DECLARE vProduced NUMERIC(10,2);
   CASE pType
    WHEN 'HONEY' THEN SELECT SUM(produced_weight) INTO vProduced FROM honey_productions WHERE produced_at BETWEEN pFrom AND pTo;
    WHEN 'WAX' THEN SELECT SUM(produced_weight)  INTO vProduced FROM wax_productions WHERE produced_at BETWEEN pFrom AND pTo;
    ELSE
      SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Name parameter has incorrect value. Use HONEY or WAX';
  END CASE;
   RETURN vProduced;
END;
