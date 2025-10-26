    public function down(): void
    {
        Schema::dropIfExists('items');
    }
