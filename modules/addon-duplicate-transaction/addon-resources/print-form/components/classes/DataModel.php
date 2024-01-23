<?php

abstract class DataModel
{
    private const MSSQL_SERVER = MSSQL_SERVER;
    private const MSSQL_USER = MSSQL_USER;
    private const MSSQL_PASSWORD = MSSQL_PASSWORD;
    private const MSSQL_DB = MSSQL_DB;

    public ?IArrayProcessor $preProcessObjRowArrResult = null;

    private function getConnection(): mixed
    {
        try {
            $connection = odbc_connect(
                "Driver={SQL Server Native Client 11.0};Server=".self::MSSQL_SERVER.";", 
                self::MSSQL_USER,
                self::MSSQL_PASSWORD
            ) or die('Could not open database!');
    
            if($connection) {
                return $connection;
            }
        } catch (\Exception $e) {
            throw $e;
        }
        
    }

    final public function getQueryResultRowObj(string $query): mixed
    {
        try {
            $MSSQL_CONN = $this->getConnection();
            $DB = self::MSSQL_DB;
            $objRowArrResult = array();
            $qry = odbc_exec($MSSQL_CONN, "USE [$DB]; $query;");
            while ($objRowArrResult[] = odbc_fetch_object($qry)){}
            unset($objRowArrResult[count($objRowArrResult) - 1]);
            odbc_free_result($qry);
            odbc_close($MSSQL_CONN);
            if ($this->preProcessObjRowArrResult != null) {
                $objRowArrResult = $this->preProcessObjRowArrResult->processArray($objRowArrResult);
            }
            return $objRowArrResult;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}