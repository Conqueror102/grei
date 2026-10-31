<?php
use App\Livewire\AdminComponent;
use App\Models\Listing;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\WithFileUploads;

new class extends AdminComponent {
    use WithFileUploads;
    #[Locked] public string $type;
    #[Locked] public int $recordId;
    public array $uploads=[]; public array $altTexts=[]; public bool $showArchived=false;
    public function mount(string $type,int $recordId):void{abort_unless(in_array($type,['listing','project']),404);$this->type=$type;$this->recordId=$recordId;$this->record();}
    public function record(){return ($this->type==='listing'?Listing::class:Project::class)::findOrFail($this->recordId);}
    #[Computed] public function files(){return $this->record()->media()->when($this->showArchived,fn($q)=>$q->withTrashed())->get();}
    public function upload():void{
        $this->validate(['uploads'=>'required|array|min:1|max:12','uploads.*'=>'required|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:102400']);
        $record=$this->record();$position=(int)$record->media()->max('position');
        foreach($this->uploads as $file){
            $image=str_starts_with($file->getMimeType(),'image/');
            if($image){$dimensions=@getimagesize($file->getRealPath());if(!$dimensions||$file->getSize()>20*1024*1024||$dimensions[0]>12000||$dimensions[1]>12000)throw ValidationException::withMessages(['uploads'=>'Images must be valid JPEG, PNG or WebP files under 20 MB and 12,000 pixels per side.']);}
        }
        foreach($this->uploads as $file){
            $path=$file->store('grei-media','local');
            try{$record->media()->create(['path'=>$path,'original_name'=>mb_substr(basename($file->getClientOriginalName()),0,240),'mime_type'=>$file->getMimeType(),'kind'=>str_starts_with($file->getMimeType(),'image/')?'image':'video','alt'=>$record->title,'size'=>$file->getSize(),'position'=>++$position]);}
            catch(\Throwable $error){Storage::disk('local')->delete($path);throw $error;}
        }
        $this->uploads=[];unset($this->files);$this->dispatch('grei:layout-change');session()->flash('media-status','Files added. The first active image is the cover.');
    }
    public function makeCover(int $id):void{$record=$this->record();$file=$record->media()->where('kind','image')->findOrFail($id);\Illuminate\Support\Facades\DB::transaction(function()use($record,$file){$items=$record->media()->lockForUpdate()->get();$ordered=collect([$file])->concat($items->where('id','!=',$file->id));foreach($ordered->values() as $index=>$item)$item->update(['position'=>$index]);});unset($this->files);}
    public function saveAlt(int $id):void{$file=$this->record()->media()->findOrFail($id);$value=$this->altTexts[$id]??$file->alt;$this->validate(['altTexts.'.$id=>'nullable|string|max:255']);$file->update(['alt'=>$value]);session()->flash('media-status','Image description saved.');}
    public function archive(int $id):void{$this->record()->media()->findOrFail($id)->delete();unset($this->files);}
    public function restore(int $id):void{$this->record()->media()->onlyTrashed()->findOrFail($id)->restore();unset($this->files);}
};
?>
<section class="admin-panel admin-media"><div class="admin-panel-heading"><div><h2>Photographs & videos</h2><p>Use real images for published listings. JPEG, PNG, WebP up to 20 MB; MP4/WebM up to 100 MB. Files stay private until the space is published.</p></div><label class="admin-check"><input type="checkbox" wire:model.live="showArchived">Show archived</label></div><form wire:submit="upload" class="admin-upload-form"><label>Add files<input type="file" wire:model="uploads" multiple accept="image/jpeg,image/png,image/webp,video/mp4,video/webm"></label>@error('uploads')<p class="field-error">{{ $message }}</p>@enderror @error('uploads.*')<p class="field-error">{{ $message }}</p>@enderror<div wire:loading wire:target="uploads">Preparing your files…</div><button class="solid-button" type="submit" wire:loading.attr="disabled">Add to gallery<x-grei.icon name="upload-simple" /></button></form>@if(session('media-status'))<p class="admin-flash" role="status">{{ session('media-status') }}</p>@endif<div class="admin-media-grid">@forelse($this->files as $file)<article wire:key="media-{{ $file->id }}">@if(!$file->trashed())@if($file->kind==='image')<img src="{{ route('media.show',$file) }}" alt="{{ $file->alt }}" width="350" height="250">@else<video controls preload="metadata"><source src="{{ route('media.show',$file) }}" type="{{ $file->mime_type }}"></video>@endif @else<div class="archived-media">Archived {{ $file->kind }}</div>@endif<p>{{ $file->original_name }}</p>@if($file->trashed())<button type="button" wire:click="restore({{ $file->id }})" class="text-link">Restore file</button>@else @if($file->kind==='image')<label>Image description<input wire:model="altTexts.{{ $file->id }}" placeholder="{{ $file->alt }}" maxlength="255"></label><div class="admin-row-actions"><button type="button" wire:click="saveAlt({{ $file->id }})">Save description</button><button type="button" wire:click="makeCover({{ $file->id }})">Make cover</button></div>@endif<button type="button" wire:click="archive({{ $file->id }})" wire:confirm="Archive this file? It will leave the public gallery and can be restored." class="text-link">Archive</button>@endif</article>@empty<p class="detail-caption">No gallery files yet. Add your first photograph above.</p>@endforelse</div></section>
