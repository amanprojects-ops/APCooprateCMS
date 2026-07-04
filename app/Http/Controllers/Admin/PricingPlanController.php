<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\PricingFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::withCount('features')->orderBy('sort_order')->paginate(15);
        return view('admin.pricing-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'nullable|string|unique:pricing_plans,slug|max:255',
            'tagline'       => 'nullable|string|max:255',
            'price'         => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,yearly,one-time',
            'is_featured'   => 'boolean',
            'is_active'     => 'boolean',
            'badge_text'    => 'nullable|string|max:100',
            'cta_text'      => 'required|string|max:100',
            'cta_url'       => 'nullable|url|max:255',
            'sort_order'    => 'integer|min:0',
            'features'      => 'nullable|array',
            'features.*.text'        => 'required|string|max:255',
            'features.*.is_included' => 'boolean',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active']   = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured');

        $plan = PricingPlan::create($validated);

        if (!empty($validated['features'])) {
            foreach ($validated['features'] as $i => $f) {
                $plan->features()->create([
                    'feature_text' => $f['text'],
                    'is_included'  => isset($f['is_included']) ? (bool)$f['is_included'] : true,
                    'sort_order'   => $i,
                ]);
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan created.');
    }

    public function edit(PricingPlan $pricingPlan)
    {
        $pricingPlan->load('features');
        return view('admin.pricing-plans.edit', compact('pricingPlan'));
    }

    public function update(Request $request, PricingPlan $pricingPlan)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'nullable|string|max:255|unique:pricing_plans,slug,' . $pricingPlan->id,
            'tagline'       => 'nullable|string|max:255',
            'price'         => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,yearly,one-time',
            'is_featured'   => 'boolean',
            'is_active'     => 'boolean',
            'badge_text'    => 'nullable|string|max:100',
            'cta_text'      => 'required|string|max:100',
            'cta_url'       => 'nullable|url|max:255',
            'sort_order'    => 'integer|min:0',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $pricingPlan->update($validated);

        // Sync features
        $pricingPlan->features()->delete();
        $features = $request->input('features', []);
        foreach ($features as $i => $f) {
            if (!empty($f['text'])) {
                $pricingPlan->features()->create([
                    'feature_text' => $f['text'],
                    'is_included'  => isset($f['is_included']) ? (bool)$f['is_included'] : true,
                    'sort_order'   => $i,
                ]);
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan updated.');
    }

    public function destroy(PricingPlan $pricingPlan)
    {
        $pricingPlan->features()->delete();
        $pricingPlan->delete();
        return back()->with('success', 'Pricing plan deleted.');
    }
}
