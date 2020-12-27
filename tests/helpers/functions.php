<?php

declare(strict_types=1);

function create(string $model, array $properties = [], string $method = 'create', int $times = null)
{
	return factory($model, $times)->$method($properties);
}
