<?php

namespace App\Http\Controllers\Web;

use App\DTO\CustomerstoreDTO;
use App\DTO\CustomerUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * @property CustomerService customerService
 */
class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function index(): View
    {

        $customers = $this->customerService->paginate();

        return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }

    public function create(): View
    {
        return view('customers.create');
    }

    public function store(StoreCustomer $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $customerstoreDTO = CustomerstoreDTO::fromRequest($validated);

            $customer = $this->customerService->store($customerstoreDTO);

            Alert::alert('Success', "Customer {$customer->full_name} created", 'success');
        } catch (\Exception $e) {
            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return redirect()->route('customers.index');

    }

    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomer $request, Customer $customer): RedirectResponse
    {

        try {
            $validated = $request->validated();

            $customerUpdateDTO = CustomerUpdateDTO::fromRequest($validated, $customer->id);
            $customer = $this->customerService->update($customerUpdateDTO);

            Alert::alert('Success', "Customer {$customer->full_name} updated", 'success');
        } catch (\Exception $e) {
            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            $this->customerService->delete($customer->id);

            Alert::alert('Success', "Customer {$customer->full_name} deleted", 'success');
        } catch (\Exception $e) {
            Alert::alert('Error', $e->getMessage(), 'error');

            return redirect()->back();
        }

        return redirect()->route('customers.index');
    }
}
