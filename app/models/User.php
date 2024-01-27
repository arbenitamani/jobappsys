<!-- models/User.php  -->
<?php class User {
    public $UserID;
    public $UserName;
    public $Email;
    public $Password;

    public function __construct($UserID, $UserName, $Email, $Password) {
        $this->UserID = $UserID;
        $this->UserName = $UserName;
        $this->Email = $Email;
        $this->Password = $Password;
    }

}