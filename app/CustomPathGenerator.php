<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
	public function getPath(Media $media): string
	{
		$folder = Str::plural(strtolower(class_basename($media->model_type)));

		return "$folder/$media->id/";
	}

	public function getPathForConversions(Media $media): string
	{
		return $this->getPath($media).'converted/';
	}

	public function getPathForResponsiveImages(Media $media): string
	{
		return $this->getPath($media).'cropped/';
	}
}
