<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * https://dcgamer.dooca.store/carrinho
     * 
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Product())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'view' => \App\Helpers\Utils::important(Self::class, \App\Helpers\Utils::CREATE, (object) []),
            'brands' => \App\Brand::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =  [
            "brand_id" => "required|integer",
            "name" => "required|max:32",
            "info" => "required",
            "detail" => "required"
        ];

        $messages = [
            "brand_id.integer" => "O código da marca deve ser inteiro",
            "name.max" => "O nome não pode ser maior que 32 caracteres"
        ];

        $request->validate($rules, $messages);

        $Product = new \App\Product();

        $Product->brand_id = (int) \App\Brand::find($request->brand_id)->id;
        $Product->name = (string) $request->name;
        $Product->detail = (string) $request->detail;
        $Product->weight = (int) $request->weight;
        $Product->info = (string) $request->info;
        $Product->image = (string) "without image";

        $Product->save();

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Product())
        ]);
    }

    /**
     * Return the content of the product.
     * 
     * @param string $name
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function name(string $type, string $name): \Illuminate\Http\JsonResponse
    {
        $ProductArray = \App\Product::with('brand')->where($type, 'like', "%{$name}%");

        $ProductToJSON = [];

        foreach ($ProductArray->get()->toArray() as $key => $product) {
            $ProductToJSON[] = [
                'id' => [
                    'type' => 'bigint(20) unsigned',
                    'value' => $product['id']
                ],
                'info' => [
                    'type' => 'longtext',
                    'value' => $product['info']
                ],
                'name' => [
                    'type' => 'varchar(32)',
                    'value' => $product['name']
                ],
                'weight' => [
                    'type' => 'int(10) unsigned',
                    'value' => $product['weight']
                ],
                'detail' => [
                    'type' => 'longtext',
                    'type' => $product['detail']
                ],
                'brand_id' => [
                    'value' => $product['brand_id'],
                    'type' => 'bigint(20) unsigned'
                ],
                "image" => [
                    'type' => 'varchar(64)',
                    'value' => $product['image']
                ],
                "link" => route('Product.show', $product['id']),
                'stock-location' => [
                    'some-place' => [
                        'quantity' => 100,
                        'price' => '89,99'
                    ],
                    'another-place' => [
                        'quantity' => 200,
                        'price' => '85,99'
                    ]
                ],
                "brand" =>  [
                    "id" => $product['brand']["id"],
                    "name" => $product['brand']["name"],
                    "created_at" => $product['brand']["created_at"],
                    "updated_at" => $product['brand']["updated_at"],
                    "deleted_at" => $product['brand']["deleted_at"],
                ],
                'created_at' => [
                    'type' => 'timestamp',
                    'value' => $product['created_at']
                ],
                'updated_at' => [
                    'type' => 'timestamp',
                    'value' => $product['updated_at']
                ],
                'deleted_at' => [
                    'type' => 'timestamp',
                    'value' => $product['deleted_at']
                ],
                'category' => 'Some Category',
            ];
        }

        return response()->json($ProductToJSON, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit', [
            'view' => \App\Helpers\Utils::important(Self::class, \App\Helpers\Utils::EDIT, (object) \App\Product::find($id)->toArray()),
            'brands' => \App\Brand::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $rules =  [
            "brand_id" => "required|integer",
            "name" => "required|max:32",
            "info" => "required",
            "detail" => "required"
        ];

        $messages = [
            "brand_id.integer" => "O código da marca deve ser inteiro",
            "name.max" => "O nome não pode ser maior que 32 caracteres"
        ];

        $request->validate($rules, $messages);

        \App\Product::find($id)->update($request->all());

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Product())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
