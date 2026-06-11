<?php
use PHPUnit\Framework\TestCase;

class DVWASecurityTest extends TestCase {

    /** @test */
    public function testSQLiInputSanitization() {
        $malicious = "1' OR '1'='1";
        $sanitized = str_replace("'", "", $malicious);
        $this->assertStringNotContainsString("'", $sanitized);
    }

    /** @test */
    public function testXSSOutputEncoding() {
        $payload = "<script>alert('xss')</script>";
        $safe    = htmlspecialchars($payload, ENT_QUOTES, "UTF-8");
        $this->assertEquals("&lt;script&gt;alert(&#039;xss&#039;)&lt;/script&gt;", $safe);
    }

    /** @test */
    public function testPasswordHashingStrength() {
        $password = "admin123";
        $hash     = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $this->assertTrue(password_verify($password, $hash));
        $this->assertStringStartsWith("\$2y\$12\$", $hash);
    }
}
