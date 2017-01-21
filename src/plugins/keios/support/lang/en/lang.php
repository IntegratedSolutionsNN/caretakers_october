<?php

return [
    'plugin'           => [
        'name'        => 'Support',
        'description' => 'Very Simple Ticket System',
    ],
    'tickets'          => [
        'delete_selected_success' => 'Successfully deleted the selected tickets.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
        'menu_label'              => 'Tickets',
        'delete_confirm'          => 'Do you really want to delete this ticket?',
        'return_to_list'          => 'Return to Tickets',
        'delete_selected_confirm' => 'Delete the selected tickets?',
    ],
    'ticket'           => [
        'new'           => 'New Ticket',
        'list_title'    => 'Manage Tickets',
        'label'         => 'Ticket',
        'create_title'  => 'Create Ticket',
        'update_title'  => 'Edit Ticket',
        'preview_title' => 'Preview Ticket',
    ],
    'components'       => [
        'ticketform'   => [
            'name'        => 'TicketForm Component',
            'description' => 'Form for clients to create tickets',
        ],
        'ticketstatus' => [
            'name'        => 'TicketStatus Component',
            'description' => 'Component for clients to check ticket status and comments',
        ],
        'ticketlist'   => [
            'name'        => 'TicketList Component',
            'description' => 'Lists all tickets for logged user',
        ],
    ],
    'ticketcategories' => [
        'menu_label'              => 'Ticket Categories',
        'delete_confirm'          => 'Do you really want to delete this ticket category?',
        'return_to_list'          => 'Return to Ticket Categories',
        'delete_selected_confirm' => 'Delete the selected ticket categories?',
        'delete_selected_success' => 'Successfully deleted the selected ticket categories.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'ticketcategory'   => [
        'new'           => 'New Ticket Category',
        'list_title'    => 'Manage Ticket Categories',
        'label'         => 'Ticket Category',
        'create_title'  => 'Create Ticket Category',
        'update_title'  => 'Edit Ticket Category',
        'preview_title' => 'Preview Ticket Category',
    ],
    'ticketcomments'   => [
        'menu_label'              => 'Ticket Comments',
        'delete_confirm'          => 'Do you really want to delete this ticket comment?',
        'return_to_list'          => 'Return to Ticket Comments',
        'delete_selected_confirm' => 'Delete the selected ticket comments?',
        'delete_selected_success' => 'Successfully deleted the selected ticket comments.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'ticketcomment'    => [
        'new'           => 'New Ticket Comment',
        'list_title'    => 'Manage Ticket Comments',
        'label'         => 'Ticket Comment',
        'create_title'  => 'Create Ticket Comment',
        'update_title'  => 'Edit Ticket Comment',
        'preview_title' => 'Preview Ticket Comment',
    ],
    'app'              => [
        'tickets'                     => 'Tickets',
        'ticketcategories'            => 'Categories',
        'ticketcreators'              => 'Creators',
        'ticket_page'                 => 'Ticket page',
        'ticket_page_desc'            => 'Page where tickets are',
        'hash'                        => 'Hash',
        'hash_desc'                   => 'Ticket hash',
        'ticketstatuses'              => 'Ticket Statuses',
        'ticketpriorities'            => 'Ticket Priorities',
        'ticketattachments'           => 'Attachments',
        'ticketstatusesandpriorities' => 'Statuses and Priorities',
    ],
    'ticketstatuses'   => [
        'delete_selected_success' => 'Successfully deleted the selected ticket statuses.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
        'menu_label'              => 'Ticket Statuses',
        'delete_confirm'          => 'Do you really want to delete this ticket status?',
        'return_to_list'          => 'Return to Ticket Statuses',
        'delete_selected_confirm' => 'Delete the selected ticket statuses?',
    ],
    'ticketstatus'     => [
        'new'           => 'New Ticket Status',
        'list_title'    => 'Manage Ticket Statuses',
        'label'         => 'Ticket Status',
        'create_title'  => 'Create Ticket Status',
        'update_title'  => 'Edit Ticket Status',
        'preview_title' => 'Preview Ticket Status',
    ],
    'ticketpriorities' => [
        'menu_label'              => 'Ticket Priorities',
        'delete_confirm'          => 'Do you really want to delete this ticket priority?',
        'return_to_list'          => 'Return to Ticket Priorities',
        'delete_selected_confirm' => 'Delete the selected ticket priorities?',
        'delete_selected_success' => 'Successfully deleted the selected ticket priorities.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'ticketpriority'   => [
        'new'           => 'New Ticket Priority',
        'list_title'    => 'Manage Ticket Priorities',
        'label'         => 'Ticket Priority',
        'create_title'  => 'Create Ticket Priority',
        'update_title'  => 'Edit Ticket Priority',
        'preview_title' => 'Preview Ticket Priority',
    ],
    'errors'           => [
        'invalid_credentials' => 'Invalid Credentials',
    ],
    'mailer'           => [
        'first'        => 'First email sent to support center user',
        'create'       => 'Email sent after creation of ticket',
        'update'       => 'Email sent after ticket update',
        'close'        => 'Email sent after ticket closed',
        'code_recover' => 'Email sent for code recovery',
    ],
    'settings'         => [
        'address'                 => 'Full ticket page address (eg http://this.domain.com/ticket/)',
        'file_type'               => 'File type',
        'file_type_description'   => 'Types of the allowed files',
        'upload_page'             => 'Upload page',
        'upload_page_description' => 'Page with Attach component',
        'upload_path'             => 'Upload path',
        'upload_path_description' => 'Path to store uploaded files',
    ],
    'message'          => [
        'success'   => 'Success!',
        'extension' => 'Invalid extension',
        'dir'       => 'Cannot create directory',
        'empty'     => 'File is empty',
    ],
    'permissions'      => [
        'tickets'    => 'Access to tickets',
        'categories' => 'Access to ticket categories',
        'statuses'   => 'Access to ticket statuses',
        'priorities' => 'Access to ticket priorities',
        'settings'   => 'Access to settings',
    ],
    'upload'           => [
        'delete_confirm' => 'Are you sure you want to remove these attachments?',
        'list_title'     => 'Attachments',
    ],
    'fields'           => [
        'author'         => 'Author',
        'comment'        => 'Comment',
        'is_support'     => 'Support',
        'created_at'     => 'Created at',
        'content'        => 'Content',
        'ticket_id'      => 'Ticket ID',
        'file_name'      => 'File name',
        'file_path'      => 'File path',
        'file_size'      => 'File size',
        'updated_at'     => 'Updated at',
        'number'         => 'Number',
        'priority'       => 'Priority',
        'status'         => 'Status',
        'assigned_user'  => 'Assigned user',
        'hash_id'        => 'Hash ID',
        'ticket_creator' => 'Ticket Creator',
        'category'       => 'Category',
        'topic'          => 'Topic',
        'files'          => 'Files',
        'comments'       => 'Comments',
        'name'           => 'Name',
        'names'          => 'Names',
    ],
];