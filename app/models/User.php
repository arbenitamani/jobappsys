<!-- models/User.php  -->
<?php class User {
    protected $UserID;
    protected $UserName;
    protected $Email;
    protected $Password;

    public function __construct($UserID, $UserName, $Email, $Password) {
        $this->UserID = $UserID;
        $this->UserName = $UserName;
        $this->Email = $Email;
        $this->Password = $Password;
    }

}