<?php

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Context\ClosuredContextInterface;
use Behat\Behat\Context\TranslatedContextInterface;
use Drupal\DrupalExtension\Context\RawDrupalContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Features context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext
{
    /**
     * @Given I prepare install new phpfox
     */
    public function iPrepareInstallNewPhpfox()
    {
        $filename = __DIR__ .'/../../install.local.php';

        if(!file_exists($filename)){
            throw new \InvalidArgumentException("configuration not found ". $filename);
        }
        $config  = include $filename;

        $mysqli  = new mysqli();
        $mysqli->connect($config['db_host'], $config['db_user'], $config['db_password'], null, $config['db_port']);

        if($mysqli->errno){
            throw new \InvalidArgumentException("Can not connect server check information ". $filename);
        }

        $mysqli->query('DROP DATABASE IF EXISTS '. $config['db_name']);

        $mysqli->query('CREATE DATABASE '. $config['db_name'] . ' COLLATE=utf8_general_ci');

        if($mysqli->errno){
            throw new \InvalidArgumentException("Can not create database");
        }

        // ok the database exists.

        $dir = $config['install_path'];

        if(is_dir($dir))
        {
            exec('mv '. $dir .' '. $dir . '-'.time());
        }
        exec('mkdir ' .$dir);
        exec('chmod 0755 '. $dir);
        chdir($dir);


        $content =  file_get_contents($config['zip_package']);

        file_put_contents('phpfox.zip', $content);
        unset($content);

        exec('unzip phpfox.zip -d .');
    }

    /**
     * @Then I fill licence information
     */
    public function iFillLicenseInformation()
    {

    }
    /**
     * @When I wait for the suggestion box to appear
     */
    public function iWaitForTheSuggestionBoxToAppear()
    {
        $this->getSession()
            ->wait(10000, "$('.suggestions-results').children().length > 0"
            );
    }

    /**
     * @When I press the :char key in the :modifier field
     *
     * @param $char
     * @param $modifier
     */
    public function iPressTheKeyInTheField($char, $modifier)
    {
        if (strtolower($char) == 'enter' || strtolower($char) == 'return') {
            $char = 13;
        }

        $field = $this->getSession()->getPage()->findField($modifier);

        if (!$field) {
            throw new InvalidArgumentException("Could not find element ",
                $modifier);
        }

        $xpath = $field->getXpath();

        $this->getSession()->getDriver()->keyDown($xpath, $char);
    }

    /**
     * @When I submit form :selector
     *
     * @param $selector
     */
    public function iSubmitForm($selector)
    {
        $session = $this->getSession();
        $page = $session->getPage();
        $form = $page->find('css', $selector);

        if (!$form) {
            throw new \InvalidArgumentException('There are no form '
                . $selector);
        }

        $form->submit();
    }

    /**
     * @Then I click :arg1 element
     */
    public function iClickElement($element)
    {
        $this->getSession()->wait(5000, '(typeof(jQuery)=="undefined" || (0 === jQuery.active && 0 === jQuery(\':animated\').length))');
        $element = $this->assertSession()->elementExists('css', $element);
        $element->click();
    }


    /**
     * When I click on xpath "a:contains('My blogs')"
     *
     * @When /^I click on xpath "([^"]*)"$/
     * @param $element
     *
     * @throws Exception
     */
    public function iClickOnXpath($element)
    {
        $page = $this->getSession()->getPage();
        $findName = $page->find("css", $element);
        if (!$findName) {
            throw new Exception($element . " could not be found");
        } else {
            $findName->click();
        }
        $this->getSession()->wait(5000, '(typeof(jQuery)=="undefined" || (0 === jQuery.active && 0 === jQuery(\':animated\').length))');
    }

    /**
     * @Given I am logged in as admin account
     */
    public function iAmLoggedInAsAdminAccount()
    {
        $this->visitPath('/login');
        $this->getSession()->getPage()->fillField('val[login]', 'vanlk@younetco.com');
        $this->getSession()->getPage()->fillField('val[password]', '123456');
        $this->iSubmitForm('#js_login_form');
    }

    /**
     * @Given I am logged in as user account
     */
    public function iAmLoggedInAsUserAccount()
    {
        $this->visitPath('/login');
        $this->getSession()->getPage()->fillField('val[login]', 'abc@yahoo.com');
        $this->getSession()->getPage()->fillField('val[password]', '123456');
        $this->iSubmitForm('#js_login_form');
    }

    /**
     * @And I wait :duration
     * @When I wait :duration
     * @param $duration
     */
    public function iWait($duration)
    {
        $this->getSession()->wait((int)$duration, '(typeof(jQuery)=="undefined" || (0 === jQuery.active && 0 === jQuery(\':animated\').length))');
    }
    /**
     * @Then I should see created title
     *
     */
    public function iShouldSeeCreatedTitle()
    {
        echo $this->fixStepArgument(ConfirmData::$_title);
    }
    /**
     * @And I click on the title
     * @When I click on the title
     */
    public function iClickOnTheTitle()
    {

        $page = $this->getSession()->getPage();
        $findName = $page->findLink($this->fixStepArgument(ConfirmData::$_title));
        if (!$findName) {
            throw new Exception(ConfirmData::$_title . " could not be found");
        } else {
            $findName->click();
        }
        $this->getSession()->wait(5000, '(typeof(jQuery)=="undefined" || (0 === jQuery.active && 0 === jQuery(\':animated\').length))');
    }

    protected function fixStepArgument($argument)
    {
        return str_replace('\\"', '"', $argument);
    }

}
