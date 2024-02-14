<?php

namespace App\Services;

use DateTimeInterface;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class TenantAwareUrlGenerator extends BaseUrlGenerator

{
    public function getUrl(): string
    {
        if(config('tenancy.central_domains.0') === $_SERVER['HTTP_HOST'])
        {
            $url = asset('/storage/'.$this->getPathRelativeToRoot());
        }
        else
        {
            $url = tenant_asset($this->getPathRelativeToRoot());
        }

        $url = $this->versionUrl($url);

        return $url;
    }
    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return $this->getDisk()->temporaryUrl($this->getPathRelativeToRoot(), $expiration, $options);
    }

    public function getBaseMediaDirectoryUrl(): string
    {
        return $this->getDisk()->url('/');
    }

    public function getPath(): string
    {
        return $this->getRootOfDisk().$this->getPathRelativeToRoot();
    }

    public function getResponsiveImagesDirectoryUrl(): string
    {
        $path = $this->pathGenerator->getPathForResponsiveImages($this->media);

        return Str::finish($this->getDisk()->url($path), '/');
    }

    protected function getRootOfDisk(): string
    {
        return $this->getDisk()->path('/');
    }
}
