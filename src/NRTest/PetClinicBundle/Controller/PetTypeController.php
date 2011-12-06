<?php

namespace NRTest\PetClinicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NRTest\PetClinicBundle\Entity\PetType;
use NRTest\PetClinicBundle\Form\PetTypeType;

/**
 * PetType controller.
 *
 */
class PetTypeController extends Controller
{
    /**
     * Lists all PetType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NRTestPetClinicBundle:PetType')->findAll();

        return $this->render('NRTestPetClinicBundle:PetType:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a PetType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:PetType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PetType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:PetType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new PetType entity.
     *
     */
    public function newAction()
    {
        $entity = new PetType();
        $form   = $this->createForm(new PetTypeType(), $entity);

        return $this->render('NRTestPetClinicBundle:PetType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new PetType entity.
     *
     */
    public function createAction()
    {
        $entity  = new PetType();
        $request = $this->getRequest();
        $form    = $this->createForm(new PetTypeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pettype_show', array('id' => $entity->getId())));
            
        }

        return $this->render('NRTestPetClinicBundle:PetType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing PetType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:PetType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PetType entity.');
        }

        $editForm = $this->createForm(new PetTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:PetType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PetType entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:PetType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PetType entity.');
        }

        $editForm   = $this->createForm(new PetTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pettype_edit', array('id' => $id)));
        }

        return $this->render('NRTestPetClinicBundle:PetType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PetType entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('NRTestPetClinicBundle:PetType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PetType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pettype'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
