<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /**
     * Test the sluggify helper function.
     *
     * Assert that it returns a URL friendly version of supplied string.
     */
    public function test_sluggifier(): void
    {
        $string = "J'était fatigue ce matin";
        $slug = sluggify($string);
        $this->assertEquals($slug, 'j-etait-fatigue-ce-matin', 'Slug is not correct');
    }
}
