<?php

class Model_agenda extends CI_Model
{
	// Nome da tabela
	
	private $tabela = 'agenda';

	// Obtêm o número registros da tabela no BD
	
	function count_rows()
	{
		return $this->db->count_all_results($this->tabela);
	}
	
	// Obtêm uma faixa de registros ( limitados pela paginação )
	
	function get_all($de = 0, $quantidade = 9)
	{
		# Quais campos devem ser retornados

		$this->db->select('id, nome, telefone, email');
		
		# Limite
		
		$this->db->limit($quantidade, $de);
		
		# Executa a consulta
		
		return $this->db->get($this->tabela);
	}
	
	// Obtêm todos os campos de um registro em particular
	
	function get_by_id($id)
	{
		# Where id do contato
		
		$this->db->where('md5(id)', md5($id));
		
		# Executa a consulta
				
		$resultado = $this->db->get($this->tabela);
		
		if( $resultado->num_rows()==0 )
		{
			return FALSE;
		}
		else
		{
			return $resultado;	
		}
	}
	
	// Atualiza um contato
	
	function update($id, $contato)
	{
		$this->db->where('md5(id)', md5($id));
		
		$this->db->update($this->tabela, $contato);

		# Força para que seja retornado um valor lógico
				
		return (bool) $this->db->affected_rows(); 
	}
	
	function insere($dados){
		
		$this->db->insert( $this->tabela, $dados);
		
		return (bool) $this->db->affected_rows();
	}
	
	// Deleta um contato
	
	function delete($id)
	{
		$this->db->where('md5(id)', md5($id));
		
		$this->db->delete($this->tabela);

		# Força para que seja retornado um valor lógico
				
		return (bool) $this->db->affected_rows(); 
	}
}