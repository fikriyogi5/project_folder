<?php
// namespace class;


class Setting {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function getSetting($settingName)
    {
        try {
            $stmt = $this->db->prepare("SELECT setting_value FROM settings WHERE setting_name = :settingName");
            $stmt->bindParam(':settingName', $settingName, PDO::PARAM_STR);
            $stmt->execute();

            // Check if the query was successful
            if ($stmt) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if a result was found
                if ($result !== false) {
                    return $result['setting_value'];
                } else {
                    // Handle the case when no result is found
                    return null;
                }
            } else {
                // Handle the case when the query fails
                return null;
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return null;
        }
    }

    public function updateSetting($settingName, $settingValue)
        {
            try {
                $stmt = $this->db->prepare("UPDATE settings SET setting_value = :settingValue WHERE setting_name = :settingName");
                $stmt->bindParam(':settingValue', $settingValue, PDO::PARAM_STR);
                $stmt->bindParam(':settingName', $settingName, PDO::PARAM_STR);
                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                // Handle the exception, log, or return an error message
                return false;
            }
        }

    // Add other setting-related methods here
}

?>
<!--  -->