<?php

namespace App\Services;

use App\Models\SeoPage;

class SeoService
{
    public function get(string $pageKey): array
    {
        $seo = SeoPage::where('page_key', $pageKey)
            ->where('is_active', true)
            ->first();

        if (!$seo) {
            return $this->default();
        }

        return [
            'title' => $seo->title,

            'description' => $seo->description,

            'canonical' => $seo->canonical_url
                ?: url()->current(),

            'og_title' => $seo->og_title
                ?: $seo->title,

            'og_description' => $seo->og_description
                ?: $seo->description,

            'og_image' => $seo->og_image,

            'schema' => $seo->schema,
        ];
    }

    private function default(): array
    {
        return [
            'title' =>
                'Exact Manpower Consulting Ltd | HR & Recruitment Services in Tanzania',

            'description' =>
                'Exact Manpower Consulting Ltd provides recruitment, HR consultancy, manpower outsourcing, payroll, Employer of Record and work permit services in Tanzania.',

            'canonical' =>
                url()->current(),

            'og_title' =>
                'Exact Manpower Consulting Ltd | HR & Recruitment Services in Tanzania',

            'og_description' =>
                'Professional HR, recruitment and manpower services in Tanzania.',

            'og_image' =>
                asset('images/seo/default.jpg'),

            'schema' => null,
        ];
    }
}