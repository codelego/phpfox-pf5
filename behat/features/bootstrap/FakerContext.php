<?php

use Behat\Mink\Element;
use Behat\MinkExtension\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Faker\Factory;
use Faker\Generator;

final class FakerContext extends RawMinkContext
{

    /**
     * @var Generator
     */
    private $_faker;

    /**
     * @var Guesser
     */
    private $_guesser;

    /**
     * @When I fill in :field
     */
    public function iFillIn($field)
    {
        $field = $this->fixStepArgument($field);
        $value = $this->faker()->text();
        $this->getSession()->getPage()->fillField($field, $value);
    }

    protected function fixStepArgument($argument)
    {
        return str_replace('\\"', '"', $argument);
    }

    /**
     * @When I fill in the form element :arg1
     */
    public function iFillInTheFormElement($arg1)
    {
        $page = $this->getSession()->getPage();
        $form = $page->find('css', $arg1);

        $this->fillForm($form);
    }

    /**
     * Fuzz fill all form fields with random data
     *
     * @param Element\NodeElement $form
     */
    protected function fillForm(Element\NodeElement $form)
    {
        $inputs = $form->findAll('css', 'input[type="text"]');
        foreach ($inputs as $i) {
            /** @var  Element\NodeElement $i */
            if ($i->isVisible()) {
                if ($i->hasAttribute('name')) {
                    $name = $i->getAttribute('name');
                    $value = $this->getFakerValue($name);
                } else {
                    $value = $this->faker()->text();
                }
                $i->setValue($value);
            }


        }
        $description = $form->findAll('css', 'textarea');
        foreach ($description as $i) {
            /** @var  Element\NodeElement $i */
            if ($i->isVisible()) {
                $value = $this->faker()->paragraphs(10, true);
                $i->setValue($value);
            }


        }


        $checkboxes = $form->findAll('css', 'input[type="checkbox"]');
        foreach ($checkboxes as $c) {
            /** @var  Element\NodeElement $c */
            if ($c->isVisible()) {
                if (rand(1, 5) == 1) {
                    $c->check();
                }
            }
        }

        $attachfields = $form->findAll('css', 'input[type="file"]');
        $Image = $this->getImageList();
        foreach ($attachfields as $field) {
            /** @var  Element\NodeElement $file */

            $file = $Image[array_rand($Image, 1)];
            if ($field->isVisible()) {
                $field->getXpath();
                $field->attachFile($file);
            }
        }
        $radios = $form->findAll('css', 'input[type="radio"]');
        $radio_names = array();
        foreach ($radios as $r) {
            /** @var  Element\NodeElement $r */
            if ($r->isVisible()) {
                if ($r->hasAttribute('name')) {
                    $name = $r->getAttribute('name');
                    if (!isset($radio_names[$name])) {
                        $radio_names[$name] = true;
                        $r->click();
                    }
                }
            }
        }
        $selects = $form->findAll('css', 'select');
        foreach ($selects as $s) {
            /** @var  Element\NodeElement $s */
            if ($s->isVisible()) {
                $s->getXpath();
                $aItems = $s->findAll('css', 'option');
                array_shift($aItems);
                $key = array_rand($aItems);
                $value = $aItems[$key]->getValue();
                $s->selectOption($value);
            }
        }
        $passwords = $form->findAll('css', 'input[type="password"]');
        $password = '123456';
        foreach ($passwords as $p) {
            if ($p->isVisible()) {
                $p->setValue($password);
            }
        }
        $confirm_emails = $form->findAll('css', 'input[name="val[confirm_email]"]');
        if (isset(ConfirmData::$_email)) {
            $confirm_email = ConfirmData::$_email;
        } else {
            $confirm_email = $this->faker()->email;
        }
        foreach ($confirm_emails as $e) {
            if ($e->isVisible()) {
                $e->setValue($confirm_email);
            }
        }


    }

    /**
     * @param string $name
     * @return bool|mixed
     */
    protected
    function getFakerValue($name)
    {
        $guess = $this->guesser()->guessFormat($name);

        if (!$guess) {
            return $this->faker()->text();
        }

        return $guess();
    }

    /**
     * @return Guesser
     */
    protected
    function guesser()
    {
        if (!$this->_guesser) {
            $this->_guesser = new Guesser($this->faker());
        }
        return $this->_guesser;
    }

    /**
     * @return Generator
     */
    protected
    function faker()
    {
        if (!$this->_faker) {
            $this->_faker = Factory::create();
        }
        return $this->_faker;
    }

    protected
    function getImageList()
    {
        $images = array();
        for ($i = 1; $i <= 92; $i++) {
            $images[$i] = vsprintf("image/%s.jpg", $i);
        }
        return $images;
    }

}