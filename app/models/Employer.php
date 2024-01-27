// models/Employer.php
class Employer extends User {
    protected $CompanyName;
    protected $Industry;
    protected $ContactInfo;

    public function __construct($UserID, $UserName, $Email, $Password, $CompanyName, $Industry, $ContactInfo) {
        parent::__construct($UserID, $UserName, $Email, $Password);
        $this->CompanyName = $CompanyName;
        $this->Industry = $Industry;
        $this->ContactInfo = $ContactInfo;
    }

    // Additional methods specific to Employer
}