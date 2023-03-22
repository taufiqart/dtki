<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\dosenTendik;
use App\Models\AlumniData;
use App\Models\AlumniKegiatan;
use App\Models\Penelitian;
use App\Models\Perlombaan;
use App\Models\LaboratoriumKegiatan;
use App\Models\PengMasyarakat;
use App\Models\ProfilLab;
use App\Models\Category;
use App\Models\Profil;
use App\Models\Galery;
use App\Models\CategoryKegiatan;
use App\Models\Laboratorium;
use App\Models\KepalaAnggotaLab;
use App\Models\Kontak;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Models\User::factory(1)->create();
		dosenTendik::factory(30)->create();
		AlumniData::factory(500)->create();
		AlumniKegiatan::factory(500)->create();
		Perlombaan::factory(500)->create();
		Penelitian::factory(500)->create();
		LaboratoriumKegiatan::factory(500)->create();
		PengMasyarakat::factory(500)->create();
		// ProfilLab::factory(4)->create();
		// Profil::factory(3)->create();
		// Category::factory(3)->create();
		Galery::factory(40)->create();
		KepalaAnggotaLab::factory(30)->create();

		KepalaAnggotaLab::create([
			'nama'=>'Kepala Lab 1',
			'nip'=> '0978966',
			'email'=> 'example@gmail.com',
			'jabatan'=>'null',
			'role_name' => 'Kepala Lab',
			'image' => '/img/foto.jpg',
			'laboratorium_id' => 1
		]);

		KepalaAnggotaLab::create([
			'nama'=>'Kepala Lab 2',
			'nip'=> '0978966',
			'email'=> 'example@gmail.com',
			'jabatan'=>'null',
			'role_name' => 'Kepala Lab',
			'image' => '/img/foto.jpg',
			'laboratorium_id' => 2
		]);
		KepalaAnggotaLab::create([
			'nama'=>'Kepala Lab 3',
			'nip'=> '0978966',
			'email'=> 'example@gmail.com',
			'jabatan'=>'null',
			'role_name' => 'Kepala Lab',
			'image' => '/img/foto.jpg',
			'laboratorium_id' => 3
		]);
		KepalaAnggotaLab::create([
			'nama'=>'Kepala Lab 4',
			'nip'=> '0978966',
			'email'=> 'example@gmail.com',
			'jabatan'=>'null',
			'role_name' => 'Kepala Lab',
			'image' => '/img/foto.jpg',
			'laboratorium_id' => 4
		]);
		Category::create([
			'nama' => 'Departemen',
			'slug' => 'departemen'
		]);
		Category::create([
			'nama' => 'Dosen',
			'slug' => 'dosen'
		]);
		Category::create([
			'nama' => 'Tendik',
			'slug' => 'tendik'
		]);
		Category::create([
			'nama' => 'Mahasiswa',
			'slug' => 'mahasiswa'
		]);

		Profil::create([
			'title'=>'Profil Departemen',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'category_id'=>1
		]);

		Profil::create([
			'title'=>'Profil Dosen',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'category_id'=>2
		]);

		Profil::create([
			'title'=>'Profil Tendik',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'category_id'=>3
		]);

		ProfilLab::create([
			'title'=>'Process Operating System Laboratory',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'laboratorium_id'=>1
		]);

		ProfilLab::create([
			'title'=>'Industrial Biotechnology Laboratory',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'laboratorium_id'=>2
		]);

		ProfilLab::create([
			'title'=>'Applied Chemistry Laboratory',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'laboratorium_id'=>3
		]);

		ProfilLab::create([
			'title'=>'Industrial Chemical Process Laboratory',
			'image'=>'https://source.unsplash.com/700x400/?rose',
			'deskripsi'=>'<a href="">Lorem ipsum dolor sit amet consectetur,</a> adipisicing elit. Veniam nobis fugiat natus nam, tempora fugit aliquid quis modi, eius saepe, ipsam odit dolorum vero. Alias enim nam modi perspiciatis odit tenetur, aliquid dolores accusantium veniam nisi distinctio aliquam ut eum voluptate? Quas eos delectus recusandae expedita cumque provident ducimus voluptatem nemo unde, id, debitis repellat, molestias cum. Error dignissimos repudiandae et vero necessitatibus soluta quis mollitia facere a, possimus fuga quo, eum explicabo magni provident rerum similique, nemo reiciendis. Aperiam, non nostrum saepe voluptatibus repudiandae, consequuntur enim neque, nesciunt mollitia aspernatur odit deleniti facere. Unde sed itaque natus. Ab totam architecto doloremque soluta adipisci, corporis quas neque maxime nulla repellendus qui, quis autem, alias repellat rerum. Vitae libero molestiae illum veritatis, corporis sint excepturi. Hic, qui, at necessitatibus dolor ipsa officiis obcaecati totam cupiditate odit similique consequuntur ad consequatur, animi quisquam maiores eos debitis ratione laudantium explicabo. Nobis nulla perferendis quas numquam, porro tenetur minima? Deleniti vel expedita architecto vitae consequatur explicabo culpa incidunt alias nihil fugiat eius, quos eligendi eum sint sequi doloribus blanditiis quidem dignissimos tenetur autem, distinctio. Esse, nesciunt enim perferendis molestias modi delectus eum assumenda quod libero vitae inventore sit ut tempore, dicta fugit, vero amet!	Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, officiis id fugit, quaerat minima repudiandae molestias non. Illo consectetur libero, dolorum debitis minus aliquam ipsa culpa voluptatum vitae quis laborum unde tenetur exercitationem provident repudiandae magnam reprehenderit voluptatibus ab rerum iste quae? Repudiandae, inventore quo cumque numquam omnis ducimus, et!',
			'laboratorium_id'=>4
		]);

		CategoryKegiatan::create([
			'nama_c' => 'Penelitian',
			'slug_c' => 'penelitian'
		]);
		CategoryKegiatan::create([
			'nama_c' => 'Proyek Akhir',
			'slug_c' => 'proyek-akhir'
		]);
		CategoryKegiatan::create([
			'nama_c' => 'Pengujian',
			'slug_c' => 'pengujian'
		]);
		CategoryKegiatan::create([
			'nama_c' => 'Perlombaan',
			'slug_c' => 'perlombaan'
		]);
		CategoryKegiatan::create([
			'nama_c' => 'Praktikum',
			'slug_c' => 'praktikum'
		]);

		Laboratorium::create([
			'nama_lab' => 'Process Operating System Laboratory',
			'slug_lab' => 'process-operating-system-laboratory'
		]);
		Laboratorium::create([
			'nama_lab' => 'Industrial Biotechnology Laboratory',
			'slug_lab' => 'industrial-biotechnology-laboratory'
		]);
		Laboratorium::create([
			'nama_lab' => 'Applied Chemistry Laboratory',
			'slug_lab' => 'applied-chemistry-laboratory'
		]);
		Laboratorium::create([
			'nama_lab' => 'Industrial Chemical Process Laboratory',
			'slug_lab' => 'industrial-chemical-process-laboratory'
		]);

		Kontak::create([
			'alamat' => 'Kampus ITS, Sukolilo-Surabaya',
			'telepon' => 'Telp: 031-5937968,<br>PABX.1274,<br>Fax: 031-5965183',
			'email' => 'dtki@its.ac.id',
			'website' => 'example.its.ac.id',
			'media_sosial' => [{"title":"Youtube","url":"https:\/\/youtube.com\/c\/TeknikKimiaIndustriFVITS","icon":"fa-youtube"},{"title":"Instagram","url":"https:\/\/instagram.com\/dtki.its","icon":"fa-instagram"}]
		]);

	}
}